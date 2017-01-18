oddin.factory("InstructionAPI", function ($http) {
	var _index = function () {
		return $http.get('/api/instructions/');
	};
	var _show = function (id) {
		return $http.get('/api/instructions/' + id);
	}
	var _create = function (instruction) {
		return $http.post('api/instructions', instruction);
	}
	var _destroy = function (id) {
		return $http.delete('api/instructions/' + id);
	}
	var _getProfile = function (id) {
		return $http.get('/api/instructions/' + id + '/profile');
	}
	var _getPresentations = function (id) {
		return $http.get('/api/instructions/' + id + '/presentations');
	}
	var _getNotices = function (id) {
		return $http.get('/api/instructions/' + id + '/notices');
	}
	var _getDates = function (id) {
		return $http.get('/api/instructions/' + id + '/dates');
	}
	var _createPresentation = function (id, presentation) {
		return $http.post('/api/instructions/' + id + '/presentations', presentation);
	}
	var _createNotice = function (id, notice) {
		return $http.post('/api/instructions/' + id + "/notices", notice)
	}

	return {
		index: _index,
		show: _show,
		create: _create,
		destroy: _destroy,
		getProfile: _getProfile,
		getPresentations: _getPresentations,
		getNotices: _getNotices,
		getDates: _getDates,
		createPresentation: _createPresentation,
		createNotice: _createNotice
	}
})
