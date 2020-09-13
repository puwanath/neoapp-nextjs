// react
import React from 'react';

// third-party
import { FormattedMessage } from 'react-intl';

// application
import AppLink from '../shared/AppLink';
import Dropdown from './Dropdown';
import DropdownLanguage from './DropdownLanguage';

export default function Topbar() {
    const links = [
        { title: <FormattedMessage id="topbar.aboutUs" defaultMessage="About Us" />, url: '/about-us' },
        { title: <FormattedMessage id="topbar.contacts" defaultMessage="Contacts" />, url: '/contact-us' },
    ];

    const linksList = links.map((item, index) => (
        <div key={index} className="topbar__item topbar__item--link">
            <AppLink href={item.url} className="topbar-link">{item.title}</AppLink>
        </div>
    ));

    return (
        <div className="site-header__topbar topbar">
            <div className="topbar__container container">
                <div className="topbar__row">
                    {linksList}
                    <div className="topbar__spring" />
                    <div className="topbar__item">
                        <DropdownLanguage />
                    </div>
                </div>
            </div>
        </div>
    );
}
