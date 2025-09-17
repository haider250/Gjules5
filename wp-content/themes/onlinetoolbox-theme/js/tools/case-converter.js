/**
 * Case Converter Tool Module
 */

function applyCaseConversion(text, mode) {
    switch (mode) {
        case 'uppercase':
            return text.toUpperCase();
        case 'lowercase':
            return text.toLowerCase();
        case 'sentencecase':
            const lowercased = text.toLowerCase();
            return lowercased.replace(/(^\s*\w|[.!?]\s*\w)/g, c => c.toUpperCase());
        case 'titlecase':
            const lowercased_title = text.toLowerCase();
            return lowercased_title.replace(/\b\w/g, c => c.toUpperCase());
        default:
            return text;
    }
}
