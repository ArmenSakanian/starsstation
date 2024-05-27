<button 
    v-if="!isPlaying" 
    @click="togglePlay" 
    class="play-button" 
    aria-label="Play video">
    <i class="fas fa-play"></i>
  </button>
  <button 
    v-if="isPlaying" 
    @click="togglePlay" 
    class="pause-button" 
    aria-label="Pause video">
    <i class="fas fa-pause"></i>
  </button>
  <button 
    @click="setFullScreen" 
    class="fullscreen-button" 
    aria-label="Fullscreen">
    <i class="fas fa-expand"></i>
  </button>


<li>
    <a href="https://www.instagram.com/starsstationstudio?igsh=cDdmczIxc2ljMzJq" aria-label="Instagram">
      <i class="fab fa-instagram custom-icon instagram-icon"></i>
    </a>
  </li>
  <li>
    <a href="#" aria-label="Facebook">
      <i class="fab fa-facebook custom-icon facebook-icon"></i>
    </a>
  </li>
  <li>
    <a href="https://wa.me/41779441743" aria-label="WhatsApp">
      <i class="fab fa-whatsapp custom-icon whatsapp-icon"></i>
    </a>
  </li>
  <li>
    <a href="https://www.youtube.com/@StarsStationStudio" aria-label="YouTube">
      <i class="fab fa-youtube custom-icon youtube-icon"></i>
    </a>
  </li>