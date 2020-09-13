// react
import React from 'react';

// third-party
import classNames from 'classnames';

export interface CategorySidebarItemProps extends React.PropsWithChildren<{}> {
    className?: string;
}

function CategorySidebarItem(props: CategorySidebarItemProps) {
    const { children, className } = props;
    const classes = classNames('block-sidebar__item', className);

    return (
        <div className={classes}>
            {children}
        </div>
    );
}

export default CategorySidebarItem;
