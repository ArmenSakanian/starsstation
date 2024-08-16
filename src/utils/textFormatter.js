// src/utils/textFormatter.js

export function formatText(i18n, key) {
    const text = i18n.t(key);
    const parts = text.split(/(<color-bold>.*?<\/color-bold>)/g).filter(Boolean);
    return parts.map(part => {
      if (part.startsWith('<color-bold>') && part.endsWith('</color-bold>')) {
        const innerText = part.slice(12, -13);
        return `<span class="color-bold">${innerText}</span>`;
      } else {
        return part;
      }
    }).join('');
  }
  