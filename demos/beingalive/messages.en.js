'use strict';

const MESSAGES = {
    'lang': 'en',
    'success': (initials, familyname, dateofbirth) => `The data that you revealed: <strong>${initials} ${familyname}, born on ${dateofbirth}</strong> are hereby accepted as proof of being alive.`,
    'data-too-old': (limit, daysDiff) => `Data for an Attestatio de Vita can be at most ${limit} days old, but the data that you revealed are from ${daysDiff} days ago. Refresh the BRP data in your IRMA app via the link below and try again.`,
    'cancelled': 'Session has been cancelled',
};
