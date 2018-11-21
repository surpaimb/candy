const state = {
    name: '',
    id: '',
    slug: '',
    thumbnail: {},
    variant: {},
    quantity: 1,
    price: 0,
    tax_total: 0
}

const mutations = {
    setProduct(state, product) {
        state.name = Candy.attribute(product, 'name');
        state.id = product.id;
        state.slug = Candy.route(product);
        state.thumbnail = product.thumbnail;
    },
    setProductVariant(state, variant) {
        state.variant = variant;
        state.price = Number(variant.price);
        state.tax_total = variant.tax_total;
    }
}

const getters = {
    variantOptions(state) {
        return state.variant.options;
    },
    variant(state) {
        return state.variant;
    },
    variantThumbnail(state) {
        if (_.has(state.variant, 'thumbnail.data.url')) {
            return state.variant.thumbnail;
        }
        return false;
    }
}

export default {
    state,
    mutations,
    getters
}