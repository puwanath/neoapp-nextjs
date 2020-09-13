// application
import enMessages from './messages/en.json';
import thMessages from './messages/th.json';
import { ILanguage } from '../interfaces/language';

const languages: ILanguage[] = [
    {
        locale: 'en',
        code: 'EN',
        name: 'English',
        icon: '/images/languages/uk.png',
        direction: 'ltr',
        messages: enMessages,
    },
    {
        locale: 'th',
        code: 'TH',
        name: 'Thailand',
        icon: '/images/languages/thailand.png',
        direction: 'ltr',
        messages: thMessages,
    },
];

export default languages;
