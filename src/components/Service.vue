<template>
  <div class="services">
    <div class="service" v-for="(service, index) in services" :key="index" :class="'service-' + (index + 1)">
      <h3 :class="['service-title', { 'service-title-2': index === 1, 'service-title-3': index === 2, 'service-title-5': index === 4 }]">{{ service.title }}</h3>      <img :src="service.image" class="service-image" alt="service image">
      <div class="learn-more-container">
        <div class="circle">
          <div class="arrow"></div>
        </div>
        <span class="learn-more">Learn more</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Services',
  data() {
    return {
      services: [
        { title: 'Услуга 1', image: require('@/assets/img/image1.png') },
        { title: 'Услуга 2', image: require('@/assets/img/image1.png') },
        { title: 'Услуга 3', image: require('@/assets/img/image1.png') },
        { title: 'Услуга 4', image: require('@/assets/img/image1.png') },
        { title: 'Услуга 5', image: require('@/assets/img/image1.png') },
      ]
    };
  }
};
</script>

<style scoped>
.services {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 20px;
  max-width: 1240px;
  margin: 0 auto;
}

.service {
  width: 500px;
  height: 240px;
  box-shadow: 0px 5px 0px 0px rgba(25, 26, 35, 1);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: space-between;
  text-align: left;
  border-radius: 45px;
  padding: 50px;
  position: relative;
}

.service-title {
  margin: 0;
  padding: 8px;
  background-color: #FF9900;
  border-radius: 7px;
}

.service-title-2, .service-title-3, .service-title-5 {
background-color: white;
color: black;}

.service-1 {
  background-color: #F3F3F3;
}

.service-2 {
  background-color: #FF9900;
}

.service-3 {
  background-color: #191A23;
  color: white;
}

.service-4 {
  background-color: #F3F3F3;
}

.service-5 {
  background-color: #FF9900;
}

.service-image {
  width: 230px;
  position: absolute;
  right: 0;
  margin-right: 35px;
  bottom: 20px;
}

.learn-more-container {
  display: flex;
  align-items: center;
  position: absolute;
  bottom: 50px;
  left: 50px;
}

.circle {
  width: 41px;
  height: 41px;
  background-color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
}

.arrow {
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid black;
  transform: rotate(30deg);
}

.learn-more {
  font-size: 16px;
  color: black;
}

h3 {
  margin: 0;
  padding: 0;
}
</style>
