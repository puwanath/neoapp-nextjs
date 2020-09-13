import shopApi from '../../api/shop';
import { IFilterValues, IListOptions } from '../../interfaces/list';
import { IProductsList } from '../../interfaces/product';
import { IShopCategory } from '../../interfaces/category';
import { SHOP_NAMESPACE } from './shopTypes';
import {
    SHOP_FETCH_CATEGORY_SUCCESS,
    SHOP_FETCH_PRODUCTS_LIST_START,
    SHOP_FETCH_PRODUCTS_LIST_SUCCESS,
    SHOP_INIT,
    SHOP_RESET_FILTERS,
    SHOP_SET_FILTER_VALUE,
    SHOP_SET_OPTION_VALUE,
    ShopFetchCategorySuccessAction,
    ShopFetchProductsListStartAction,
    ShopFetchProductsListSuccessAction,
    ShopInitAction,
    ShopResetFiltersAction,
    ShopSetFilterValueAction,
    ShopSetOptionValueAction,
    ShopThunkAction,
} from './shopActionTypes';

let cancelPreviousCategoryRequest = () => {};
let cancelPreviousProductsListRequest = () => {};

export function shopInit(
    categorySlug: string | null,
    options: IListOptions = {},
    filters: IFilterValues = {},
): ShopInitAction {
    return {
        type: SHOP_INIT,
        categorySlug,
        options,
        filters,
    };
}

export function shopFetchCategorySuccess(category: IShopCategory | null): ShopFetchCategorySuccessAction {
    return {
        type: SHOP_FETCH_CATEGORY_SUCCESS,
        category,
    };
}

export function shopFetchProductsListStart(): ShopFetchProductsListStartAction {
    return {
        type: SHOP_FETCH_PRODUCTS_LIST_START,
    };
}

export function shopFetchProductsListSuccess(productsList: IProductsList): ShopFetchProductsListSuccessAction {
    return {
        type: SHOP_FETCH_PRODUCTS_LIST_SUCCESS,
        productsList,
    };
}

export function shopResetFilters(): ShopResetFiltersAction {
    return {
        type: SHOP_RESET_FILTERS,
    };
}

export function shopSetOptionValue(option: string, value: string): ShopSetOptionValueAction {
    return {
        type: SHOP_SET_OPTION_VALUE,
        option,
        value,
    };
}

export function shopSetFilterValue(filter: string, value: string | null): ShopSetFilterValueAction {
    return {
        type: SHOP_SET_FILTER_VALUE,
        filter,
        value,
    };
}

export function shopFetchCategoryThunk(categorySlug: string | null): ShopThunkAction<Promise<void>> {
    return async (dispatch) => {
        let canceled = false;

        cancelPreviousCategoryRequest();
        cancelPreviousCategoryRequest = () => { canceled = true; };

        let request: Promise<IShopCategory | null>;

        if (categorySlug) {
            request = shopApi.getCategoryBySlug(categorySlug);
        } else {
            request = Promise.resolve(null);
        }

        const category = await request;

        if (canceled) {
            return;
        }

        dispatch(shopFetchCategorySuccess(category));
    };
}

export function shopFetchProductsListThunk(): ShopThunkAction<Promise<void>> {
    return async (dispatch, getState) => {
        let canceled = false;

        cancelPreviousProductsListRequest();
        cancelPreviousProductsListRequest = () => { canceled = true; };

        dispatch(shopFetchProductsListStart());

        const shopState = getState()[SHOP_NAMESPACE];

        let { filters } = shopState;

        if (shopState.categorySlug !== null) {
            filters = { ...filters, category: shopState.categorySlug };
        }

        const productsList = await shopApi.getProductsList(shopState.options, filters);

        if (canceled) {
            return;
        }

        dispatch(shopFetchProductsListSuccess(productsList));
    };
}

export function shopSetOptionValueThunk(option: string, value: string): ShopThunkAction<Promise<void>> {
    return async (dispatch) => {
        dispatch(shopSetOptionValue(option, value));
        await dispatch(shopFetchProductsListThunk());
    };
}

export function shopSetFilterValueThunk(filter: string, value: string | null): ShopThunkAction<Promise<void>> {
    return async (dispatch) => {
        dispatch(shopSetFilterValue(filter, value));
        await dispatch(shopFetchProductsListThunk());
    };
}

export function shopResetFiltersThunk(): ShopThunkAction<Promise<void>> {
    return async (dispatch) => {
        dispatch(shopResetFilters());
        await dispatch(shopFetchProductsListThunk());
    };
}

export function shopInitThunk(
    categorySlug: string | null,
    options: IListOptions = {},
    filters: IFilterValues = {},
): ShopThunkAction<Promise<void>> {
    return async (dispatch) => {
        dispatch(shopInit(categorySlug, options, filters));

        await Promise.all([
            dispatch(shopFetchCategoryThunk(categorySlug)),
            dispatch(shopFetchProductsListThunk()),
        ]);
    };
}
