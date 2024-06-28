<template>
    <div class="subscribe_section">
        <div class="subscribe-image">
            <img src="" alt="subscribe">
        </div>
        <div class="subscribe-form">
            <div class="form-title">
                <h1></h1>
            </div>
            <div class="form container">
                <form @submit.prevent="subscribe">
                    <p>{{ $t('newsletter_text') }}</p>
                    <div class="form-group">
                        <input type="email" v-model="email" placeholder="Email">
                        <button class="subscribe">{{ $t('send') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    name: 'Subscribe',
    inject: ['splitText'],
    data() {
        return {
            email: ''
        };
    },
    methods: {
        async subscribe() {
            try {
                const response = await axios.post('subscribe.php', new URLSearchParams({ email: this.email }));
                console.log(response.data); // Добавьте эту строку для отладки
                Swal.fire({
                    icon: 'success',
                    title: this.$t('success_title'),
                    text: this.$t(response.data.message_id), // Используем message_id для перевода
                    timer: 3000,
                    showConfirmButton: true,
                    timerProgressBar: true,
                    confirmButtonText: 'OK'
                });
                this.email = '';  // Очистить поле ввода
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: this.$t('error_title'),
                    text: this.$t('subscribe_error'),
                    timer: 3000,
                    showConfirmButton: true,
                    timerProgressBar: true,
                    confirmButtonText: 'OK'
                });
            }
        }
    }
}
</script>
  
<style scoped>
.subscribe_section {
    width: 100%;
    height: 350px;
    background-color: black;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 15pxп;
}
.form-group input, .form-group button {
    width: 200px;
    height: 55px;
    border-radius: 38px;
}
.form-group input {
    border: 2px solid #CED8DF;
    background-color: transparent;
}

.form-group button {
    border: none;
    background-color: var(--active-color);
    color: black;
}
</style>
  