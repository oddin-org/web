const router = require('express').Router()
const controller = require('../../controllers/ws/instruction')

router.get('/instructions', controller.index)
router.get('/instructions/:id', controller.show)
router.post('/instructions', controller.create)
router.put('/instructions/:id', controller.update)
router.delete('/instructions/:id', controller.destroy)
router.get('/instructions/:id/presentations', controller.showPresentations)
router.post('/instructions/:id/presentations', controller.createPresentation)
router.post('/instructions/:id/materials', controller.createMaterial)
router.post('/instructions/:id/notices', controller.createNotice)
router.get('/instructions/:id/materials', controller.showMaterials)
router.get('/instructions/:id/participants', controller.showParticipants)
router.get('/instructions/:id/notices', controller.showNotices)
router.get('/instructions/:id/dates', controller.showDates)
router.get('/instructions/:id/profile', controller.showProfile)

module.exports = router
