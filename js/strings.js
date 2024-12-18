class Strings {

    static BASE_LOREM_LENGTH = 500;

    static getLorem(text, length = 500) {
        return text.substring(0, length);
    }

    static toUpperCase(text) {
        return text.toUpperCase();
    }

    static toLowerCase(text) {
        return text.toLowerCase();
    }

    static toCamelCase(data) {
        const parts = data.split(' ');
        if (parts.length === 1) {
            return parts[0].charAt(0).toUpperCase() + parts[0].slice(1);
        }

        return parts.map((part, index) => {
            if (index === 0) {
                return part.toLowerCase();
            }
            return part.charAt(0).toUpperCase() + part.slice(1);
        }).join('');
    }

    static allWordsCapitalized(data) {
        const parts = data.split(' ');

        return parts.map(part => part.charAt(0).toUpperCase() + part.slice(1)).join(' ');
    }

    static reverseText(text) {
        return text.split('').reverse().join('');
    }

    static truncate(text) {
        return text.replace(/\s+/g, '');
    }

    static toUnderscored(text) {
        return text.replace(/[\s._,]+/g, '_');
    }

    static removeUnderscores(text) {
        return text.replace(/_/g, ' ');
    }

    static toHyphenized(text) {
        return text.replace(/[\s.-]+/g, '-');
    }

    static startsWith(haystack, needle) {
        return haystack.startsWith(needle);
    }

    static endsWith(haystack, needle) {
        return haystack.endsWith(needle);
    }

    static capitalize(text) {
        return text.charAt(0).toUpperCase() + text.slice(1);
    }

    static shorten(text, length) {
        if (text.length <= length) {
            return text;
        }
        return text.substring(0, length) + '...';
    }

    static hyphensToCamel(text, uncapitalize = true) {
        return this.convertToCamel(text, '-', uncapitalize);
    }

    static convertToCamel(text, separator, uncapitalize = true) {
        let result = text.split(separator).map((word, index) => {
            return index === 0 ? word.toLowerCase() : word.charAt(0).toUpperCase() + word.slice(1);
        }).join('');

        if (uncapitalize) {
            result = this.uncapitalize(result);
        }

        return result;
    }

    static uncapitalize(text) {
        return text.charAt(0).toLowerCase() + text.slice(1);
    }

    static snakeToCamel(text, uncapitalize = true) {
        return this.convertToCamel(text, '_', uncapitalize);
    }

    static camelToHyphens(text) {
        return this.convertFromCamel(text, '-');
    }

    static convertFromCamel(text, separator) {
        let result = text.replace(/([A-Z])/g, match => separator + match.toLowerCase());
        return result.trim();
    }

    static camelToSnake(text) {
        return this.convertFromCamel(text, '_');
    }

    static hashRandom(min = 1, max = 9999) {
        return this.md5(Math.floor(Math.random() * (max - min + 1)) + min);
    }

    static md5(str) {
        let hash = 0, i, chr;
        if (str.length === 0) return hash.toString(16);
        for (i = 0; i < str.length; i++) {
            chr = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + chr;
            hash |= 0; // Convert to 32bit integer
        }
        return hash.toString(16);
    }
}
