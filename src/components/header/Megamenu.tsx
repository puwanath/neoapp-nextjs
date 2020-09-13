// react
import React from 'react';

// application
import MegamenuLinks from './MegamenuLinks';
import { useDirection } from '../../store/locale/localeHooks';
import { IMegamenu } from '../../interfaces/menus/megamenu';

export type MegamenuLocation = 'nav-links' | 'department';

export interface MegamenuProps {
    menu: IMegamenu;
    location?: MegamenuLocation;
}

function Megamenu(props: MegamenuProps) {
    const { menu, location = 'nav-links' } = props;
    const direction = useDirection();

    if (!menu) {
        return null;
    }

    let menuStyle = {};
    let { image } = menu;

    if (image) {

        menuStyle = {
            backgroundImage: `url('${image}')`,
        };
    }

    const columns = menu.columns.map((column, index) => (
        <div key={index} className={`col-${column.size}`}>
            <MegamenuLinks links={column.links} />
        </div>
    ));

    return (
        <div className={`megamenu megamenu--${location}`} style={menuStyle}>
            <div className="row">
                {columns}
            </div>
        </div>
    );
}

export default Megamenu;
