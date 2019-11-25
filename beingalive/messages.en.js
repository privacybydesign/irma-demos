'use strict';

const MESSAGES = {
    'lang': 'en',
    'success': (initials, familyname, dateofbirth) => `De door u onthulde persoonsgegevens <strong>${initials} ${familyname}, geboren op ${dateofbirth}</strong> zijn bij deze geaccepteerd als Attesta di Vita.`,
    'data-too-old': (limit, daysDiff) => `Gegevens voor een Attestatie de Vita mogen hooguit ${limit} dagen oud zijn, maar de door u onthulde gegevens zijn van ${daysDiff} dagen geleden. Ververs de BRP gegevens in uw IRMA app via onderstaande link en probeer het dan opnieuw.`,
    'cancelled': 'Session has been cancelled',
};
