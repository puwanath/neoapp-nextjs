import React from 'react';

// third-party
import Link, { LinkProps } from 'next/link';
import { ILinkProps } from '../../interfaces/menus/link-props';

export type LinkType = string | ILinkProps;

export interface AppLinkProps extends React.PropsWithChildren<React.HTMLAttributes<HTMLElement>> {
    href?: LinkType;
    target?: React.AnchorHTMLAttributes<HTMLAnchorElement>['target'];
}

function isLink(href: LinkType | undefined): href is LinkType {
    return href !== undefined;
}
function isSimpleLink(href: LinkType | undefined): href is string {
    return href !== undefined && typeof href === 'string';
}
function isExternal(href: string): boolean {
    return /^(https?:)?\/\//.test(href);
}

function AppLink(props: AppLinkProps) {
    const { href, children, ...anchorProps } = props;

    let link;

    if (!isLink(href) || (isSimpleLink(href) && isExternal(href))) {
        link = <a href={href} {...anchorProps}>{children}</a>;
    } else {
        const linkProps: LinkProps = typeof href === 'string' ? { href } : href;

        link = (
            <Link {...linkProps}>
                <a {...anchorProps}>{children}</a>
            </Link>
        );
    }

    return link;
}

export default AppLink;
