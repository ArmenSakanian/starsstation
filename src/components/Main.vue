<template>
    <div class="greetings_container">
        <div class="greetings_info">
            <div class="greetings_title">
                <h1>Mastering the Art of Visual Storytelling for Success</h1>
            </div>
            <div class="greetings_text">
                <p>Our video production company helps businesses grow and succeed through a range of services including commercial filming, promotional videos, film production, and editing and post-production.

                </p>
            </div>
        </div>
        <div class="greetings_photo">
            <img src="@/assets/img/greetings.png" alt="">
        </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Main',
    inject: ['splitText'],
  };
  </script>
  
  <style scoped>
  .greetings_container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 100px 0 100px;
}

.greetings_info, .greetings_photo {
    flex: 1;
}


.greetings_photo img {
    max-width: 100%;
    height: auto; 
    display: block;
    margin: 0 auto; 
}

  .greetings_title h1 {
    font-size: 60px;
    margin-bottom: 35px;
  }

  .greetings_text, .greetings_title{
    padding-right: 50px;
  }
  .greetings_text p {
    font-size: 20px;
  }
  </style>
  