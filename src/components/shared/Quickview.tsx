// react
import React from 'react';

// third-party
import { Modal } from 'reactstrap';

// application
import Cross20Svg from '../../svg/cross-20.svg';
import Product from './Product';
import { useQuickview, useQuickviewClose } from '../../store/quickview/quickviewHooks';

function Quickview() {
    const quickview = useQuickview();
    const quickviewClose = useQuickviewClose();

    let productView;

    if (quickview.product !== null) {
        productView = <Product product={quickview.product} layout="quickview" />;
    }

    return (
        <Modal isOpen={quickview.open} toggle={quickviewClose} centered size="xl">
            <div className="quickview">
                <button className="quickview__close" type="button" onClick={quickviewClose}>
                    <Cross20Svg />
                </button>

                {productView}
            </div>
        </Modal>
    );
}

export default Quickview;
