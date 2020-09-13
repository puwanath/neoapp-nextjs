// react
import React from 'react';

// application
import AppLink from '../shared/AppLink';
import CartIndicator from './IndicatorCart';
import Departments from './Departments';
import Heart20Svg from '../../svg/heart-20.svg';
import Indicator from './Indicator';
import IndicatorAccount from './IndicatorAccount';
import IndicatorSearch from './IndicatorSearch';
import LogoSmallSvg from '../../svg/neotechlogo.svg';
import NavLinks from './NavLinks';
import { useWishlist } from '../../store/wishlist/wishlistHooks';

export type NavPanelLayout = 'default' | 'compact';

export interface NavPanelProps {
    layout?: NavPanelLayout;
}

function NavPanel(props: NavPanelProps) {
    const { layout = 'default' } = props;
    const { items: { length: wishlistCount } } = useWishlist();

    let logo = null;
    let departments = null;
    let searchIndicator;

    if (layout === 'compact') {
        logo = (
            <div className="nav-panel__logo">
                <AppLink href="/">
                    <img src="/images/logos/neotechlogo.png" alt="" />
                </AppLink>
            </div>
        );

        searchIndicator = <IndicatorSearch />;
    }

    if (layout === 'default') {
        departments = (
            <div className="nav-panel__departments">
                <Departments />
            </div>
        );
    }

    return (
        <div className="nav-panel">
            <div className="nav-panel__container container">
                <div className="nav-panel__row">
                    {logo}
                    {departments}

                    <div className="nav-panel__nav-links nav-links">
                        <NavLinks />
                    </div>

                    <div className="nav-panel__indicators">
                        {searchIndicator}
                        <CartIndicator />
                    </div>
                </div>
            </div>
        </div>
    );
}

export default NavPanel;
