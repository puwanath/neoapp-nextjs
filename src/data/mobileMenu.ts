import { IMobileMenu } from '../interfaces/menus/mobile-menu';

const dataMobileMenu: IMobileMenu = [
    {
        type: 'link',
        title: 'Home',
        url: '/',
    },
    {
        type: 'link',
        title: 'Products',
        url: '/products',
        children:[
            {
                type: 'link',
                title: 'Categories',
                url: '/products/categories',
            },{
                type: 'link',
                title: 'Process',
                url: '/products/process',
            },
            {
                type: 'link',
                title: 'Application',
                url: '/products/application',
            },
            {
                type: 'link',
                title: 'Suppliers',
                url: '/products/suppliers',
            },
        ]
    },
    {
        type: 'link',
        title: 'Knowledge',
        url: '/knowledge',
        children:[
            {
                type: 'link',
                title: 'Process',
                url: '/knowledge/process',
            },
            {
                type: 'link',
                title: 'Application',
                url: '/knowledge/application',
            }
        ]
    },
    {
        type: 'link',
        title: 'News/Update',
        url: '/news-update',
    },
    {
        type: 'link',
        title: 'Suppliers',
        url: '',
        children:[
            
        ]
    },
    {
        type: 'link',
        title: 'About us',
        url: '/about-us',
    },
    {
        type: 'link',
        title: 'Contact us',
        url: '/contact-us'
    },
    {
        type: 'button',
        title: 'Get Quote',
    },
    {
        type: 'button',
        title: 'Language',
        children: [
            { type: 'button', title: 'English', data: { type: 'language', locale: 'en' } },
            { type: 'button', title: 'Thailand', data: { type: 'language', locale: 'th' } },
        ],
    },
];

export default dataMobileMenu;
