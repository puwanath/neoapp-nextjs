// react
import React, { useEffect, useRef } from 'react';

// third-party
import classNames from 'classnames';

// application
import AppLink from '../shared/AppLink';
import departmentsService from '../../services/departmentsService';
import StroykaSlick from '../shared/StroykaSlick';
import { useDirection } from '../../store/locale/localeHooks';
import { useMedia } from '../../services/hooks';

export interface BlockSlideShowProps {
    withDepartments?: boolean;
}

const slickSettings = {
    dots: true,
    arrows: false,
    infinite: true,
    speed: 400,
    slidesToShow: 1,
    slidesToScroll: 1,
};

const slides = [
    {
        title: 'นีโอเทค คอมโพสิท',
        text: 'ผู้นำเข้าอุปกรณ์คอมโพสิต ทุกชนิดราคาย่อมเยาว์',
        image_classic: {
            ltr: '/images/slides/banner1500.jpg',
        },
        image_full: {
            ltr: '/images/slides/banner1500.jpg',
        },
        image_mobile: {
            ltr: '/images/slides/banner1500.jpg',
        },
    },
    // {
    //     title: '',
    //     text: '',
    //     image_classic: {
    //         ltr: '/images/slides/bannerslide2.jpg',
    //     },
    //     image_full: {
    //         ltr: '/images/slides/bannerslide2.jpg',
    //     },
    //     image_mobile: {
    //         ltr: '/images/slides/bannerslide2.jpg',
    //     },
    // },
    // {
    //     title: 'Screwdrivers<br>Professional Tools',
    //     text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.',
    //     image_classic: {
    //         ltr: '/images/slides/slide-2-ltr.jpg',
    //         rtl: '/images/slides/slide-2-rtl.jpg',
    //     },
    //     image_full: {
    //         ltr: '/images/slides/slide-2-full-ltr.jpg',
    //         rtl: '/images/slides/slide-2-full-rtl.jpg',
    //     },
    //     image_mobile: {
    //         ltr: '/images/slides/slide-2-mobile.jpg',
    //         rtl: '/images/slides/slide-2-mobile.jpg',
    //     },
    // },
    // {
    //     title: 'One more<br>Unique header',
    //     text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.',
    //     image_classic: {
    //         ltr: '/images/slides/slide-3-ltr.jpg',
    //         rtl: '/images/slides/slide-3-rtl.jpg',
    //     },
    //     image_full: {
    //         ltr: '/images/slides/slide-3-full-ltr.jpg',
    //         rtl: '/images/slides/slide-3-full-rtl.jpg',
    //     },
    //     image_mobile: {
    //         ltr: '/images/slides/slide-3-mobile.jpg',
    //         rtl: '/images/slides/slide-3-mobile.jpg',
    //     },
    // },
];

function BlockSlideShow(props: BlockSlideShowProps) {
    const { withDepartments = false } = props;
    const direction = useDirection();
    const departmentsAreaRef = useRef<HTMLDivElement | null>(null);
    const isDesktop = useMedia('(min-width: 992px)');

    useEffect(() => () => {
        departmentsService.area = null;
    }, []);

    useEffect(() => {
        departmentsService.area = departmentsAreaRef.current;
    }, [isDesktop, departmentsAreaRef]);

    const setDepartmentsAreaRef = (ref: HTMLDivElement | null) => {
        departmentsAreaRef.current = ref;

        if (isDesktop) {
            departmentsService.area = departmentsAreaRef.current;
        }
    };

    const blockClasses = classNames(
        'block-slideshow block',
        {
            'block-slideshow--layout--full mg-t-no': !withDepartments,
            'block-slideshow--layout--with-departments': withDepartments,
        },
    );

    const layoutClasses = classNames(
        'pd-x-no',
    );

    const slidesList = slides.map((slide, index) => {
        const image = (withDepartments ? slide.image_classic : slide.image_full)[direction];

        return (
            <div key={index} className="block-slideshow__slide">
                <div
                    className="block-slideshow__slide-image block-slideshow__slide-image--desktop"
                    style={{
                        backgroundImage: `url(${image})`,
                    }}
                />
                <div
                    className="block-slideshow__slide-image block-slideshow__slide-image--mobile"
                    style={{
                        backgroundImage: `url(${slide.image_mobile[direction]})`,
                    }}
                />
                <div className="container">
                    <div className="block-slideshow__slide-content">
                        <div
                            className="block-slideshow__slide-title"
                            dangerouslySetInnerHTML={{ __html: slide.title }}
                        />
                        <div
                            className="block-slideshow__slide-text"
                            dangerouslySetInnerHTML={{ __html: slide.text }}
                        />
                        {/* <div className="block-slideshow__slide-button">
                            <AppLink href="/" className="btn btn-primary btn-lg">Shop Now</AppLink>
                        </div> */}
                    </div>
                </div>
                
                
            </div>
        );
    });

    return (
        <div className={blockClasses}>
            {/* <div className="container-fluid pd-x-no mg-t-no"> */}
                {/* <div className="row"> */}
                    <div className={layoutClasses}>
                        <div className="block-slideshow__body">
                            <StroykaSlick {...slickSettings}>
                                {slidesList}
                            </StroykaSlick>
                        </div>
                    </div>
                {/* </div> */}
            {/* </div> */}
        </div>
    );
}

export default BlockSlideShow;
