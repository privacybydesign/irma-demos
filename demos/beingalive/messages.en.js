'use strict';

const MESSAGES = {
    'lang': 'en',
    'success': (initials, familyname, dateofbirth) => {
        const fragment = document.createDocumentFragment();
        fragment.append('The data that you revealed: ');
        const strong = document.createElement('strong');
        strong.textContent = `${initials} ${familyname}, born on ${dateofbirth}`;
        fragment.append(strong);
        fragment.append(' are hereby accepted as proof of being alive.');
        return fragment;
    },
    'data-too-old': (limit, daysDiff) => `Data for an Attestatio de Vita can be at most ${limit} days old, but the data that you revealed are from ${daysDiff} days ago. Refresh the BRP data in your Yivi app via the link below and try again.`,
    'cancelled': 'Session has been cancelled',
};
