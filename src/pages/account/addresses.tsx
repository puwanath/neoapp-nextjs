// react
import React from 'react';
// application
import AccountLayout from '../../components/account/AccountLayout';
import AccountPageAddresses from '../../components/account/AccountPageAddresses';

function Page() {
    return <AccountPageAddresses />;
}

Page.Layout = AccountLayout;

export default Page;
