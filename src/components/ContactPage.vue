<template>
  <section class="contact-section section-space">
    <div class="page-shell">
      <div class="contact-shell glass" data-aos="fade-up">
        <aside class="contact-info">
          <span class="eyebrow">{{ $t('contact_kicker') }}</span>
          <h2 class="section-title">{{ $t('feedback') }}</h2>
          <p class="lead">{{ $t('video_description') }}</p>

          <div class="contact-list">
            <a :href="`mailto:${contacts.email}`">
              <span class="contact-icon"><i class="fa-regular fa-envelope"></i></span>
              <div><small>{{ $t('email') }}</small><strong>{{ contacts.email }}</strong></div>
            </a>
            <a :href="`tel:${contacts.phone}`">
              <span class="contact-icon"><i class="fa-solid fa-phone"></i></span>
              <div><small>{{ $t('tel') }}</small><strong>{{ contacts.phone }}</strong></div>
            </a>
          </div>

          <div class="contact-art" aria-hidden="true">
            <div class="art-orbit"></div>
            <img src="@/assets/logo/Logomark_White.svg" alt="" />
          </div>
        </aside>

        <form ref="form" class="contact-form" @submit.prevent="submitForm" novalidate>
          <div class="form-grid">
            <label class="field">
              <span>{{ $t('name') }} *</span>
              <input v-model.trim="inputs.name" type="text" name="name" maxlength="120" required autocomplete="given-name" />
            </label>
            <label class="field">
              <span>{{ $t('surname') }}</span>
              <input v-model.trim="inputs.surname" type="text" name="surname" maxlength="120" autocomplete="family-name" />
            </label>
            <label class="field">
              <span>{{ $t('email') }} *</span>
              <input v-model.trim="inputs.email" type="email" name="email" maxlength="190" required autocomplete="email" />
            </label>
            <label class="field">
              <span>{{ $t('tel') }}</span>
              <input v-model.trim="inputs.tel" type="tel" name="tel" maxlength="40" autocomplete="tel" />
            </label>
          </div>

          <label class="field message-field">
            <span>{{ $t('message') }} *</span>
            <textarea v-model="inputs.message" name="message" rows="6" maxlength="1000" required></textarea>
            <small :class="{ danger: inputs.message.length >= 950 }">{{ inputs.message.length }}/1000</small>
          </label>

          <div class="upload-box" :class="{ dragging: isDragging }" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop">
            <input ref="fileInput" id="attachment" type="file" multiple :accept="acceptString" @change="handleFileInput" />
            <button type="button" class="upload-trigger" @click="$refs.fileInput.click()">
              <span><i class="fa-solid fa-paperclip"></i></span>
              <div><strong>{{ $t('attach') }}</strong><small>{{ $t('file_help') }}</small></div>
            </button>
          </div>

          <transition-group v-if="files.length" name="file" tag="div" class="file-list">
            <div v-for="(file, index) in files" :key="file.key" class="file-pill">
              <i :class="file.icon"></i>
              <span>{{ file.name }}</span>
              <small>{{ formatBytes(file.size) }}</small>
              <button type="button" @click="removeFile(index)" aria-label="Remove"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </transition-group>

          <label class="check-row">
            <input v-model="consentGiven" type="checkbox" />
            <span class="custom-check"><i class="fa-solid fa-check"></i></span>
            <span>{{ $t('agreement') }} <router-link to="/privacy">{{ $t('privacy_policy_title') }}</router-link>.</span>
          </label>
          <label class="check-row">
            <input v-model="subscribeToNewsletter" type="checkbox" />
            <span class="custom-check"><i class="fa-solid fa-check"></i></span>
            <span>{{ $t('newsletter_text') }}</span>
          </label>

          <div class="form-bottom">
            <p class="status-text" :class="status.type" aria-live="polite">{{ status.message }}</p>
            <button class="primary-btn send-btn" type="submit" :disabled="isSubmitting">
              <span>{{ isSubmitting ? $t('sending') : $t('send') }}</span>
              <i :class="isSubmitting ? 'fa-solid fa-spinner fa-spin' : 'fa-solid fa-arrow-right'"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import contacts from '@/contacts.json';

export default {
  name: 'ContactPage',
  data() {
    return {
      contacts,
      inputs: { name: '', surname: '', email: '', tel: '', message: '' },
      files: [],
      csrfToken: '',
      consentGiven: false,
      subscribeToNewsletter: false,
      isSubmitting: false,
      isDragging: false,
      status: { type: '', message: '' },
      maxSize: 10 * 1024 * 1024,
      maxFiles: 5,
      allowedExtensions: ['png','jpg','jpeg','gif','bmp','tiff','svg','pdf','docx','txt','odt','xlsx','ods','pptx','odp']
    };
  },
  computed: {
    acceptString() { return this.allowedExtensions.map(ext => `.${ext}`).join(','); }
  },
  methods: {
    async ensureCsrf() {
      if (this.csrfToken) return this.csrfToken;
      const response = await fetch('/get_csrf_token.php', { credentials: 'same-origin' });
      if (!response.ok) throw new Error('Unable to initialize form security.');
      const data = await response.json();
      this.csrfToken = data.token;
      return this.csrfToken;
    },
    handleFileInput(event) { this.addFiles(Array.from(event.target.files || [])); event.target.value = ''; },
    handleDrop(event) { this.isDragging = false; this.addFiles(Array.from(event.dataTransfer.files || [])); },
    addFiles(incoming) {
      for (const file of incoming) {
        if (this.files.length >= this.maxFiles) { this.notifyError(`Maximum ${this.maxFiles} files.`); break; }
        const ext = (file.name.split('.').pop() || '').toLowerCase();
        if (!this.allowedExtensions.includes(ext)) { this.notifyError(`${file.name}: ${this.$t('unsupported_file_type')}`); continue; }
        if (file.size > this.maxSize) { this.notifyError(`${file.name}: ${this.$t('is_too_large')}. ${this.$t('maximum_size_is')} 10 MB.`); continue; }
        if (this.files.some(item => item.name === file.name && item.size === file.size)) { this.notifyError(`${file.name}: ${this.$t('duplicate_file')}`); continue; }
        this.files.push({ original: file, key: `${file.name}-${file.size}-${file.lastModified}`, name: file.name, size: file.size, icon: this.iconFor(ext) });
      }
    },
    removeFile(index) { this.files.splice(index, 1); },
    iconFor(ext) {
      if (['png','jpg','jpeg','gif','bmp','tiff','svg'].includes(ext)) return 'fa-regular fa-image';
      if (ext === 'pdf') return 'fa-regular fa-file-pdf';
      if (['docx','odt'].includes(ext)) return 'fa-regular fa-file-word';
      if (['xlsx','ods'].includes(ext)) return 'fa-regular fa-file-excel';
      if (['pptx','odp'].includes(ext)) return 'fa-regular fa-file-powerpoint';
      return 'fa-regular fa-file-lines';
    },
    formatBytes(bytes) {
      if (bytes < 1024) return `${bytes} B`;
      if (bytes < 1024 * 1024) return `${(bytes / 1024).toFixed(1)} KB`;
      return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    },
    validate() {
      const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.inputs.email);
      if (!this.inputs.name || !this.inputs.email || !this.inputs.message || !emailOk) return this.$t('fill_all_fields');
      if (!this.consentGiven) return this.$t('you_must_agree_to_the_processing_of_personal_data');
      return '';
    },
    notifyError(message) {
      this.status = { type: 'error', message };
      window.Swal?.fire({ icon: 'warning', title: this.$t('error_title'), text: message, confirmButtonColor: '#7c5cff' });
    },
    async submitForm() {
      if (this.isSubmitting) return;
      const validationError = this.validate();
      if (validationError) { this.notifyError(validationError); return; }

      this.isSubmitting = true;
      this.status = { type: '', message: '' };
      try {
        const csrf = await this.ensureCsrf();
        const formData = new FormData();
        Object.entries(this.inputs).forEach(([key, value]) => formData.append(key, value));
        this.files.forEach(item => formData.append('files[]', item.original, item.name));
        formData.append('csrf_token', csrf);
        formData.append('language', this.$i18n.locale);
        formData.append('subscribe', this.subscribeToNewsletter ? 'true' : 'false');

        const response = await fetch('/sendmail.php', { method: 'POST', body: formData, credentials: 'same-origin' });
        const data = await response.json();
        if (!response.ok || data.status !== 'success') throw new Error(data.message || this.$t('error_message'));

        this.status = { type: 'success', message: this.$t('success_message') };
        window.Swal?.fire({ icon: 'success', title: this.$t('success_title'), text: this.$t('success_message'), confirmButtonColor: '#7c5cff' });
        this.inputs = { name: '', surname: '', email: '', tel: '', message: '' };
        this.files = [];
        this.consentGiven = false;
        this.subscribeToNewsletter = false;
        this.csrfToken = '';
      } catch (error) {
        this.status = { type: 'error', message: error.message };
        window.Swal?.fire({ icon: 'error', title: this.$t('error_title'), text: error.message, confirmButtonColor: '#7c5cff' });
      } finally { this.isSubmitting = false; }
    }
  }
};
</script>

<style scoped>
.contact-section { position: relative; }
.contact-shell { display: grid; grid-template-columns: .82fr 1.18fr; min-height: 720px; border-radius: 36px; overflow: hidden; background: linear-gradient(145deg, rgba(17,20,33,.82), rgba(8,10,17,.80)); }
.contact-info { position: relative; padding: 54px; overflow: hidden; background: linear-gradient(160deg, rgba(124,92,255,.14), rgba(46,230,214,.035) 55%, transparent); }
.contact-info h2 { margin: 22px 0; }
.contact-info .lead { max-width: 480px; font-size: 17px; }
.contact-list { display: grid; gap: 10px; margin-top: 35px; }
.contact-list a { display: flex; align-items: center; gap: 13px; padding: 14px; border: 1px solid var(--line); border-radius: 17px; background: rgba(255,255,255,.035); text-decoration: none; transition: transform .25s ease, border-color .25s ease; }
.contact-list a:hover { transform: translateX(4px); border-color: rgba(46,230,214,.36); }
.contact-icon { width: 42px; height: 42px; flex-shrink: 0; display: grid; place-items: center; border-radius: 13px; background: rgba(124,92,255,.18); color: #c9c1ff; }
.contact-list div { min-width: 0; display: grid; gap: 3px; }
.contact-list small { color: var(--text-soft); }
.contact-list strong { font-size: 14px; overflow: hidden; text-overflow: ellipsis; }
.contact-art { position: absolute; width: 260px; height: 260px; left: -55px; bottom: -65px; display: grid; place-items: center; }
.contact-art img { width: 90px; animation: floatMark 6s ease-in-out infinite; }
.art-orbit { position: absolute; inset: 0; border: 1px solid rgba(255,255,255,.09); border-radius: 50%; box-shadow: inset 0 0 60px rgba(124,92,255,.09); }
.art-orbit::before, .art-orbit::after { content: ""; position: absolute; inset: 28px; border: 1px dashed rgba(46,230,214,.14); border-radius: 50%; animation: orbit 14s linear infinite; }
.art-orbit::after { inset: 64px; animation-direction: reverse; animation-duration: 9s; }
.contact-form { padding: 54px; }
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.field { position: relative; display: grid; gap: 9px; }
.field > span { color: #b9c0d1; font-size: 12px; font-weight: 700; letter-spacing: .04em; }
.field input, .field textarea { width: 100%; border: 1px solid var(--line); border-radius: 15px; background: rgba(255,255,255,.035); color: #fff; outline: none; transition: border-color .25s ease, box-shadow .25s ease, background .25s ease; }
.field input { height: 55px; padding: 0 15px; }
.field textarea { min-height: 145px; padding: 15px; resize: vertical; line-height: 1.55; }
.field input:focus, .field textarea:focus { border-color: rgba(124,92,255,.72); box-shadow: 0 0 0 4px rgba(124,92,255,.09); background: rgba(255,255,255,.05); }
.message-field { margin-top: 16px; }
.message-field small { position: absolute; right: 12px; bottom: 10px; color: #707990; font-size: 10px; }
.message-field small.danger { color: var(--warning); }
.upload-box { margin-top: 16px; border: 1px dashed rgba(255,255,255,.16); border-radius: 17px; transition: background .25s ease, border-color .25s ease; }
.upload-box.dragging { border-color: var(--accent-2); background: rgba(46,230,214,.06); }
.upload-box input { display: none; }
.upload-trigger { width: 100%; padding: 15px; border: 0; background: transparent; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 13px; text-align: left; }
.upload-trigger > span { width: 42px; height: 42px; flex-shrink: 0; display: grid; place-items: center; border-radius: 13px; background: rgba(46,230,214,.10); color: var(--accent-2); }
.upload-trigger div { display: grid; gap: 4px; }
.upload-trigger strong { font-size: 13px; }
.upload-trigger small { color: #707990; font-size: 10px; }
.file-list { display: grid; gap: 7px; margin-top: 10px; }
.file-pill { display: grid; grid-template-columns: 20px minmax(0,1fr) auto 30px; align-items: center; gap: 8px; min-height: 42px; padding: 5px 6px 5px 12px; border: 1px solid var(--line); border-radius: 12px; background: rgba(255,255,255,.03); color: #cbd1df; font-size: 12px; }
.file-pill > span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.file-pill > small { color: #6f7890; }
.file-pill button { width: 30px; height: 30px; border: 0; border-radius: 9px; background: rgba(255,255,255,.05); color: #fff; cursor: pointer; }
.check-row { position: relative; display: flex; align-items: flex-start; gap: 10px; margin-top: 15px; color: #aab2c5; font-size: 12px; line-height: 1.5; cursor: pointer; }
.check-row input { position: absolute; opacity: 0; pointer-events: none; }
.custom-check { width: 20px; height: 20px; flex-shrink: 0; border: 1px solid var(--line); border-radius: 6px; display: grid; place-items: center; background: rgba(255,255,255,.035); color: transparent; transition: .2s ease; }
.check-row input:checked + .custom-check { background: var(--accent); border-color: var(--accent); color: #fff; }
.check-row a { color: #dcd7ff; }
.form-bottom { min-height: 58px; margin-top: 24px; display: flex; align-items: center; justify-content: space-between; gap: 18px; }
.status-text { color: #7e879e; font-size: 12px; }
.status-text.success { color: var(--success); }
.status-text.error { color: var(--danger); }
.send-btn { min-width: 150px; }
.send-btn:disabled { opacity: .62; cursor: wait; transform: none; }
.file-enter-active, .file-leave-active { transition: opacity .2s ease, transform .2s ease; }
.file-enter-from, .file-leave-to { opacity: 0; transform: translateY(-5px); }
@keyframes orbit { to { transform: rotate(360deg); } }
@keyframes floatMark { 50% { transform: translateY(-10px) rotate(-4deg); } }
@media (max-width: 950px) { .contact-shell { grid-template-columns: 1fr; } .contact-info { min-height: 430px; } .contact-art { right: -50px; left: auto; } }
@media (max-width: 620px) { .contact-shell { border-radius: 26px; } .contact-info, .contact-form { padding: 30px 20px; } .form-grid { grid-template-columns: 1fr; } .form-bottom { align-items: stretch; flex-direction: column; } .send-btn { width: 100%; } .contact-art { width: 180px; height: 180px; opacity: .6; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.contact-shell { border-radius: 12px; border-color: rgba(255,255,255,.16); background: #0a1420; }
.contact-info { background: linear-gradient(160deg, rgba(94,183,255,.075), rgba(100,92,255,.035) 52%, transparent); }
.contact-list a { border-radius: 10px; background: rgba(255,255,255,.025); }
.contact-icon { border-radius: 50%; background: rgba(255,255,255,.075); color: #fff; }
.field input, .field textarea { border-radius: 9px; background: rgba(255,255,255,.025); }
.field input:focus, .field textarea:focus { border-color: rgba(94,183,255,.58); box-shadow: 0 0 0 3px rgba(94,183,255,.07); }
.upload-box { border-radius: 10px; }
.upload-trigger > span { border-radius: 50%; background: rgba(255,255,255,.07); color: #fff; }
.file-pill { border-radius: 8px; }
</style>
