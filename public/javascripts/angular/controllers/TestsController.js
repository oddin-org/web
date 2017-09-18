import oddin from '../app'

oddin.controller('TestsController',
  ['$scope', '$stateParams', 'InstructionAPI', 'CurrentUser',
    function ($scope, $stateParams, InstructionAPI, CurrentUser) {
      $scope.user = CurrentUser
      $scope.newTest = {
        questions: [{
          alternatives: [{}],
        }],
      };

      (function getInfo() {
        $scope.load = false
        InstructionAPI.show($stateParams.instructionID)
                .then(function (response) {
                  $scope.instruction = response.data
                })
                .catch(function () {
                  Materialize.toast('Erro ao carregar informações da disciplina', 3000)
                })
                .finally(function () {
                  $scope.load = true
                })
      }())

      $scope.addNewTooltip = function(){
        setTimeout(function(){
            $('.tooltipped').tooltip();
        },200);
      };

      $(document).ready(function(){
        $('.tooltipped').tooltip();
        $('.materialize-textarea').characterCounter();
      });

      $scope.addNewQuestion = function () {
        $scope.newTest.questions.push(angular.copy({}));
        $scope.addNewTooltip();
      }
      $scope.removeQuestion = function (questionPosition) {
        $scope.newTest.questions.splice(questionPosition, 1);
      }
      $scope.addNewAlternative = function (questionPosition) {
        if ($scope.newTest.questions[questionPosition].alternatives == undefined) {
          $scope.newTest.questions[questionPosition].alternatives = []
        }
        if ($scope.newTest.questions[questionPosition].alternatives != undefined) {
          $scope.newTest.questions[questionPosition].alternatives.push(angular.copy({}))
        }
      }
      $scope.removeAlternative = function (questionPosition) {
        var lastItem = $scope.newTest.questions[questionPosition].alternatives.length - 1

        $scope.newTest.questions[questionPosition].alternatives.splice(lastItem)
      }
      $scope.dissertativeQuestion = function (questionPositionT) {
        var value = $('#kind-question-' + questionPositionT).prop('checked')

        switch (value) {
          case true:
            return true
          case false:
            $scope.addNewTooltip();
            return false
        }
      }
    },
  ])
