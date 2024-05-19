
<template>
    <div class="loading">
      <img src="@/assets/1.gif" alt="Loading" />
    </div>
  </template>
  
  <script>
  export default {
    name: 'LoadingScreen'
  }
  </script>
  
  <style scoped>
  .loading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #fff;
  }

  img {
    width: 100%;
  }
  </style>
  