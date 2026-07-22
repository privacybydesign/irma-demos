'use strict';

const MESSAGES = {
    'lang': 'nl',
    'success': (initials, familyname, dateofbirth) => {
        const fragment = document.createDocumentFragment();
        fragment.append('De door u onthulde persoonsgegevens ');
        const strong = document.createElement('strong');
        strong.textContent = `${initials} ${familyname}, geboren op ${dateofbirth}`;
        fragment.append(strong);
        fragment.append(' zijn bij deze geaccepteerd als bewijs van in leven zijn.');
        return fragment;
    },
    'data-too-old': (limit, daysDiff) => `Gegevens voor een Attestatie de Vita mogen hooguit ${limit} dagen oud zijn, maar de door u onthulde gegevens zijn van ${daysDiff} dagen geleden. Ververs de BRP gegevens in uw Yivi app via onderstaande link en probeer het dan opnieuw.`,
    'cancelled': 'Sessie is afgebroken',
};
