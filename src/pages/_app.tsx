// react
import React, { ComponentType, useEffect, useMemo } from 'react';
// third-party
import { AppProps } from 'next/app';
import { IntlProvider } from 'react-intl';
import { NextComponentType, NextPageContext } from 'next/dist/next-server/lib/utils';
import { useStore } from 'react-redux';
// application
import Layout from '../components/Layout';
import { load, save, wrapper } from '../store/store';
import { useApplyClientState } from '../store/client';
import { useDirection, useLocale, useMessages } from '../store/locale/localeHooks';
// styles
import '../scss/index.scss';

export type NeoAppProps = AppProps & {
    Component: NextComponentType<NextPageContext, any> & {
        Layout: ComponentType
    }
};

function NeoApp({ Component, pageProps, router }: NeoAppProps) {
    const headerLayout = 'compact';
    const applyClientState = useApplyClientState();
    const locale = useLocale();
    const messages = useMessages();
    const direction = useDirection();
    const store = useStore();

    // preloader
    useEffect(() => {
        const preloader = document.querySelector('.site-preloader');

        if (!preloader) {
            return;
        }

        setTimeout(() => {
            const onTransitionEnd = (event: Event) => {
                if (event instanceof TransitionEvent && event.propertyName === 'opacity' && preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            };

            preloader.addEventListener('transitionend', onTransitionEnd);
            preloader.classList.add('site-preloader__fade');

            if (getComputedStyle(preloader).opacity === '0' && preloader.parentNode) {
                preloader.parentNode.removeChild(preloader);
            }
        }, 100);
    }, []);

    // Loading and saving state on the client side (cart, wishlist, etc.).
    useEffect(() => {
        const state = load();

        if (state) {
            applyClientState(state);
        }

        if (process.browser) {
            store.subscribe(() => {
                save(store.getState());
            });
        }
    }, [store]);

    useEffect(() => {
        document.documentElement.lang = locale;
        document.documentElement.dir = direction;
    }, [direction, locale]);

    const content = useMemo(() => {
        const PageLayout = Component.Layout || React.Fragment;

        return (
            <Layout headerLayout={headerLayout}>
                <PageLayout>
                    <Component {...pageProps} />
                </PageLayout>
            </Layout>
        );
    }, [headerLayout, Component, pageProps]);

    return (
        <IntlProvider locale={locale} messages={messages}>
            {content}
        </IntlProvider>
    );
}

export default wrapper.withRedux(NeoApp);
