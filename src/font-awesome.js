// font-awesome.js
import { library } from '@fortawesome/fontawesome-svg-core'
import { faInstagram, faFacebook, faWhatsapp, faYoutube } from '@fortawesome/free-brands-svg-icons'
import { faPlay, faPause, faExpand } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Добавьте иконки в библиотеку
library.add(faInstagram, faFacebook, faWhatsapp, faYoutube, faPlay, faPause, faExpand)

export default FontAwesomeIcon
