<template>
    <div class="subscribe_section">
        <div class="subscribe-form">
            <div class="form-title">
                <h1>{{ $t('newsletter_text') }}</h1>
            </div>
            <div class="form-container">
                <form @submit.prevent="subscribe">
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
    position: relative;
    width: 100%;
    height: 250px;
    background-image: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .3)), url(@/assets/img/subscribe.webp);
    background-position: center;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

.subscribe-form {
    display: flex;
    width: 100%;
    max-width: 600px;
    position: absolute;
    align-items: center;
    right: 0;
}

.form-title {
    text-align: center;
    width: 100%;
    color: white;
}

.form-title h1 {
    font-size: 36px;
}

.form-container {
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
}

.form-group input,
.form-group button {
    width: 200px;
    height: 55px;
    border-radius: 38px;
}

.form-group input {
    border: 2px solid #CED8DF;
    background-color: transparent;
    padding: 10px;
    color: white;
}

.form-group input::placeholder {
    color: white;
}

.form-group button {
    border: none;
    background-color: var(--active-color);
    color: black;
}
</style>
