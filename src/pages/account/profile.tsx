// react
import React from 'react';
// application
import AccountLayout from '../../components/account/AccountLayout';
import AccountPageProfile from '../../components/account/AccountPageProfile';

function Page() {
    return <AccountPageProfile />;
}

Page.Layout = AccountLayout;

export default Page;
