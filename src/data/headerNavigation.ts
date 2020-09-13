import { INav } from '../interfaces/menus/nav';

const dataHeaderNavigation: INav = [
    {
        title: 'Home',
        url: '/',
    },
    {
        title: 'Products',
        url: '/products',
        submenu: {
            type: 'menu',
            menu: [
                { title: 'Categories', url: '/products/categories' },
                { title: 'Process', url: '/products/process' },
                { title: 'Application', url: '/products/application' },
                { title: 'Suppliers', url: '/products/suppliers' },
            ],
        },
    },
    { 
        title: 'Knowledge',
        url: '/knowledge',
        submenu: {
            type: 'menu',
            menu: [
                { title: 'Process', url: '/knowledge/process' },
                { title: 'Application', url: '/knowledge/application' },
            ],
        },
    },
    {
        title: 'News/Update',
        url: '/news-update',
    },
    {
        title: 'Suppliers',
        url: '',
        submenu:{
            type: 'megamenu',
            menu: {
                size: 'nl',
                columns: [
                    {
                        size: 12,
                        links: []
                    }
                ]
            }
        }
    },
    {
        title: 'About us',
        url: '/about-us',
    },
    {
        title: 'Contact us',
        url: '/contact-us'
    },
];

export default dataHeaderNavigation;
