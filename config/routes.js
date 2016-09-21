const index = require('../routes/index')
const auth = require('../routes/auth')
const home = require('../routes/home')
const lecture = require('../routes/lecture')
const presentation = require('../routes/presentation')
const partials = require('../routes/partials')

const ws = {}
ws.answer = require('../routes/ws/answer')
ws.instruction = require('../routes/ws/instruction')
ws.material = require('../routes/ws/material')
ws.presentation = require('../routes/ws/presentation')
ws.question = require('../routes/ws/question')
ws.date = require('../routes/ws/date')

module.exports = function routesConfig(app) {
  app.use('/', index)
  app.use('/', auth)
  app.use('/', home)
  app.use('/', lecture)
  app.use('/', presentation)
  app.use('/', partials)

  app.use('/api', ws.answer)
  app.use('/api', ws.instruction)
  app.use('/api', ws.material)
  app.use('/api', ws.presentation)
  app.use('/api', ws.question)
  app.use('/api', ws.date)
}
