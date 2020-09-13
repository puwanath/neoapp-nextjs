// react
import React from 'react';
// application
import AccountLayout from '../../components/account/AccountLayout';
import AccountPageOrders from '../../components/account/AccountPageOrders';

function Page() {
    return <AccountPageOrders />;
}

Page.Layout = AccountLayout;

export default Page;
