import { library } from '@fortawesome/fontawesome-svg-core'
import { faInstagram, faFacebook, faWhatsapp, faYoutube } from '@fortawesome/free-brands-svg-icons' // Импорт иконок брендов
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faInstagram, faFacebook, faWhatsapp, faYoutube) // Добавление иконок в библиотеку

export default FontAwesomeIcon