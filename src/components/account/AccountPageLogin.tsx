// react
import React from 'react';

// third-party
import Head from 'next/head';

// application
import AppLink from '../shared/AppLink';
import Check9x7Svg from '../../svg/check-9x7.svg';
import PageHeader from '../shared/PageHeader';

// data stubs
import theme from '../../data/theme';

export default function AccountPageLogin() {
    const breadcrumb = [
        { title: 'Home', url: '' },
        { title: 'My Account', url: '' },
    ];

    return (
        <React.Fragment>
            <Head>
                <title>{`Login — ${theme.name}`}</title>
            </Head>

            <PageHeader header="My Account" breadcrumb={breadcrumb} />

            <div className="block">
                <div className="container">
                    <div className="row">
                        <div className="col-md-6 d-flex">
                            <div className="card flex-grow-1 mb-md-0">
                                <div className="card-body">
                                    <h3 className="card-title">Login</h3>
                                    <form>
                                        <div className="form-group">
                                            <label htmlFor="login-email">Email address</label>
                                            <input
                                                id="login-email"
                                                type="email"
                                                className="form-control"
                                                placeholder="Enter email"
                                            />
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="login-password">Password</label>
                                            <input
                                                id="login-password"
                                                type="password"
                                                className="form-control"
                                                placeholder="Password"
                                            />
                                            <small className="form-text text-muted">
                                                <AppLink href="/">Forgotten Password</AppLink>
                                            </small>
                                        </div>
                                        <div className="form-group">
                                            <div className="form-check">
                                                <span className="form-check-input input-check">
                                                    <span className="input-check__body">
                                                        <input
                                                            id="login-remember"
                                                            type="checkbox"
                                                            className="input-check__input"
                                                        />
                                                        <span className="input-check__box" />
                                                        <Check9x7Svg className="input-check__icon" />
                                                    </span>
                                                </span>
                                                <label className="form-check-label" htmlFor="login-remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" className="btn btn-primary mt-2 mt-md-3 mt-lg-4">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 d-flex mt-4 mt-md-0">
                            <div className="card flex-grow-1 mb-0">
                                <div className="card-body">
                                    <h3 className="card-title">Register</h3>
                                    <form>
                                        <div className="form-group">
                                            <label htmlFor="register-email">Email address</label>
                                            <input
                                                id="register-email"
                                                type="email"
                                                className="form-control"
                                                placeholder="Enter email"
                                            />
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="register-password">Password</label>
                                            <input
                                                id="register-password"
                                                type="password"
                                                className="form-control"
                                                placeholder="Password"
                                            />
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="register-confirm">Repeat Password</label>
                                            <input
                                                id="register-confirm"
                                                type="password"
                                                className="form-control"
                                                placeholder="Password"
                                            />
                                        </div>
                                        <button type="submit" className="btn btn-primary mt-2 mt-md-3 mt-lg-4">
                                            Register
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </React.Fragment>
    );
}
