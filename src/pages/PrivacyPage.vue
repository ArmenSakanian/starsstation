<template>
  <div class="privacy-page page-top">
    <section class="page-shell privacy-hero" data-aos="fade-up">
      <span class="eyebrow">{{ $t('legal_kicker') }}</span>
      <h1 class="display-title gradient-text">{{ $t('privacy_policy_title') }}</h1>
      <p class="lead">{{ $t('data_collection_note') }}</p>
    </section>

    <section class="page-shell privacy-layout section-space">
      <aside class="privacy-nav glass" data-aos="fade-right">
        <span>{{ $t('contents_label') }}</span>
        <a v-for="(item, index) in sections" :key="item.title" :href="`#privacy-${index}`">0{{ index + 1 }} · {{ $t(item.title) }}</a>
      </aside>

      <div class="privacy-content">
        <article v-for="(section, index) in sections" :id="`privacy-${index}`" :key="section.title" class="privacy-card glass" data-aos="fade-up">
          <div class="section-number">0{{ index + 1 }}</div>
          <div>
            <h2>{{ $t(section.title) }}</h2>
            <p v-if="section.intro">{{ $t(section.intro) }}</p>
            <ul v-if="section.items?.length">
              <li v-for="item in section.items" :key="item">{{ $t(item) }}</li>
            </ul>
            <p v-if="section.outro">{{ $t(section.outro) }}<template v-if="section.email"> <a href="mailto:support@starsstation.ch">support@starsstation.ch</a>.</template></p>
          </div>
        </article>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'PrivacyPage',
  data() {
    return {
      sections: [
        { title: 'data_collection_title', intro: 'data_collection_intro', items: ['data_collection_item_name','data_collection_item_surname','data_collection_item_phone','data_collection_item_email','data_collection_item_message','data_collection_item_files'], outro: 'data_collection_note' },
        { title: 'data_usage_title', intro: 'data_usage_intro', items: ['data_usage_response','data_usage_message_processing','data_usage_service_improvement','data_usage_security'] },
        { title: 'data_sharing_title', intro: 'data_sharing_intro', items: ['data_sharing_authorities','data_sharing_security','data_sharing_contractors'] },
        { title: 'data_storage_title', intro: 'data_storage_intro' },
        { title: 'user_rights_title', intro: 'user_rights_intro', items: ['user_rights_access','user_rights_correction','user_rights_deletion'], outro: 'user_rights_contact', email: true },
        { title: 'contact_info_title', intro: 'contact_info_intro', outro: 'contact_info_email', email: true },
        { title: 'data_security_title', intro: 'data_security_intro', items: ['data_security_access_control','data_security_encryption','data_security_monitoring'], outro: 'data_security_conclusion' }
      ]
    };
  }
};
</script>

<style scoped>
.privacy-page { overflow: hidden; }
.privacy-hero { padding-top: 70px; }
.privacy-hero h1 { max-width: 900px; margin: 24px 0; }
.privacy-hero .lead { max-width: 700px; }
.privacy-layout { display: grid; grid-template-columns: 280px 1fr; align-items: start; gap: 24px; }
.privacy-nav { position: sticky; top: 110px; padding: 20px; border-radius: 22px; display: grid; gap: 7px; background: rgba(12,14,23,.72); }
.privacy-nav > span { color: #6e7790; font-size: 10px; text-transform: uppercase; letter-spacing: .14em; margin: 4px 8px 10px; }
.privacy-nav a { padding: 10px; border-radius: 11px; color: #b9c0d2; text-decoration: none; font-size: 12px; line-height: 1.4; transition: background .2s ease, color .2s ease; }
.privacy-nav a:hover { background: rgba(124,92,255,.11); color: #fff; }
.privacy-content { display: grid; gap: 14px; }
.privacy-card { scroll-margin-top: 110px; display: grid; grid-template-columns: 70px 1fr; gap: 22px; padding: 30px; border-radius: 24px; background: rgba(255,255,255,.028); }
.section-number { color: var(--accent-2); font-size: 12px; letter-spacing: .12em; }
.privacy-card h2 { font-size: clamp(24px, 3vw, 34px); letter-spacing: -.035em; margin-bottom: 14px; }
.privacy-card p, .privacy-card li { color: var(--text-soft); font-size: 14px; line-height: 1.75; }
.privacy-card ul { display: grid; gap: 7px; margin: 14px 0; padding-left: 19px; }
.privacy-card li::marker { color: var(--accent); }
.privacy-card a { color: #dcd7ff; }
@media (max-width: 900px) { .privacy-layout { grid-template-columns: 1fr; } .privacy-nav { position: relative; top: auto; grid-template-columns: 1fr 1fr; } .privacy-nav > span { grid-column: 1/-1; } }
@media (max-width: 600px) { .privacy-hero { padding-top: 40px; } .privacy-nav { grid-template-columns: 1fr; } .privacy-card { grid-template-columns: 1fr; gap: 12px; padding: 22px; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.privacy-nav { border-radius: 10px; background: rgba(255,255,255,.025); }
.privacy-card { border-radius: 10px; background: rgba(255,255,255,.018); box-shadow: none; }
.privacy-card h2 { font-family: var(--font-display); font-weight: 500; font-size: clamp(30px, 3.5vw, 42px); }
</style>
