<template>
    <div class="container">
      <div class="privacy-policy">
        <h1>{{ $t('privacy_policy_title') }}</h1>
        <div class="section">
          <h2>{{ $t('data_collection_title') }}</h2>
          <p>{{ $t('data_collection_intro') }}</p>
          <ul>
            <li>{{ $t('data_collection_item_name') }}</li>
            <li>{{ $t('data_collection_item_surname') }}</li>
            <li>{{ $t('data_collection_item_phone') }}</li>
            <li>{{ $t('data_collection_item_email') }}</li>
            <li>{{ $t('data_collection_item_message') }}</li>
            <li>{{ $t('data_collection_item_files') }}</li>
          </ul>
          <p>{{ $t('data_collection_note') }}</p>
        </div>
        <div class="section">
          <h2>{{ $t('data_usage_title') }}</h2>
          <p>{{ $t('data_usage_intro') }}</p>
          <ul>
            <li>{{ $t('data_usage_response') }}</li>
            <li>{{ $t('data_usage_message_processing') }}</li>
            <li>{{ $t('data_usage_service_improvement') }}</li>
            <li>{{ $t('data_usage_security') }}</li>
          </ul>
        </div>
        <div class="section">
          <h2>{{ $t('data_sharing_title') }}</h2>
          <p>{{ $t('data_sharing_intro') }}</p>
          <ul>
            <li>{{ $t('data_sharing_authorities') }}</li>
            <li>{{ $t('data_sharing_security') }}</li>
            <li>{{ $t('data_sharing_contractors') }}</li>
          </ul>
        </div>
        <div class="section">
          <h2>{{ $t('data_storage_title') }}</h2>
          <p>{{ $t('data_storage_intro') }}</p>
        </div>
        <div class="section">
          <h2>{{ $t('user_rights_title') }}</h2>
          <p>{{ $t('user_rights_intro') }}</p>
          <ul>
            <li>{{ $t('user_rights_access') }}</li>
            <li>{{ $t('user_rights_correction') }}</li>
            <li>{{ $t('user_rights_deletion') }}</li>
          </ul>
          <p>{{ $t('user_rights_contact') }} support@starsstation.ch.</p>
        </div>
        <div class="section">
          <h2>{{ $t('contact_info_title') }}</h2>
          <p>{{ $t('contact_info_intro') }}</p>
          <p>{{ $t('contact_info_email') }} support@starsstation.ch.</p>
        </div>
        <div class="section">
          <h2>{{ $t('data_security_title') }}</h2>
          <p>{{ $t('data_security_intro') }}</p>
          <ul>
            <li>{{ $t('data_security_access_control') }}</li>
            <li>{{ $t('data_security_encryption') }}</li>
            <li>{{ $t('data_security_monitoring') }}</li>
          </ul>
          <p>{{ $t('data_security_conclusion') }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'PrivacyPage'
  };
  </script>
  
  <style scoped>
  
  .container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; 
  padding: 20px;
  background-color: var(--bg-main-color); 
}

.privacy-policy {
  background-color: var(--bg-main-color);
  padding: 20px;
  border-radius: 8px;
  color: var(--text-color);
  max-width: 800px; 
  width: 100%; 
  text-align: center; 
}

.privacy-policy h1 {
  color: var(--active-color);
  font-size: 2em;
  margin-bottom: 20px;
  text-align: center;
}

.privacy-policy h2 {
  color: var(--active-color);
  font-size: 1.5em;
  margin-top: 20px;
  text-align: center;
}

.privacy-policy p, .privacy-policy ul, .privacy-policy li {
  color: var(--text-color);
  font-size: 1em;
  line-height: 1.6;
  margin: 10px 0;
  text-align: center; 
}

.privacy-policy ul {
  list-style-type: none;
  padding-left: 0;
}

.privacy-policy ul li::before {
  content: '•'; 
  color: var(--text-color);
  display: inline-block; 
  width: 1em; 
  margin-left: -1em; 
}

.section {
  margin-bottom: 20px;
}

@media (max-width: 768px) {
  .privacy-policy {
    padding: 15px;
  }

  .privacy-policy h1 {
    font-size: 1.5em;
  }

  .privacy-policy h2 {
    font-size: 1.2em;
  }

  .privacy-policy p, .privacy-policy ul, .privacy-policy li {
    font-size: 0.9em;
  }
}
  </style>
  