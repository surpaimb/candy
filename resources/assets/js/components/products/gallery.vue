<template>
    <div class="product-gallery">
        <div class="item featured">
             <a v-if="current.kind == 'image'" :href="current.url" data-lity>
               <img :src="current.thumbnail" />
            </a>
            <iframe v-if="current.kind == 'youtube'" :src="youtubeEmbed(current.url)" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
            <iframe v-if="current.kind == 'vimeo'" :src="vimeoEmbed(current.url)" width="100%" height="340" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="item" v-for="asset in getAssets()" :key="asset.id" @click="selected = asset">
            <img :src="getTransform(asset, 'thumbnail')" />
            <img class="video-play" src="/images/video-play.png" v-if="asset.kind == 'vimeo'" />
            <img class="video-play" src="/images/video-play.png" v-if="asset.kind == 'youtube'" />
        </div>
    </div>
    <!-- <div class="product-gallery">
        <div class="item featured">

        </div>
        <div class="item" v-for="asset in getAssets()" :key="asset.id" @click="setFeatured(asset)">
            <img :src="getTransform(asset, 'thumbnail')" />
            <img class="video-play" src="/images/video-play.png" v-if="asset.kind == 'youtube'" />
        </div>
    </div> -->
</template>

<script>
    import Lity from 'lity';
    export default {
        component: {
            Lity
        },
        data() {
            return {
                selected: null
            }
        },
        props: {
            product: {
                type: Object,
                default() {
                    return {};
                }
            }
        },
        computed: {
            current() {
                if (!this.selected) {
                    if (!this.variant.thumbnail) {
                        return this.product.assets.data[0];
                    } else {
                        return this.variant.thumbnail.data;
                    }
                }
                return this.selected;
            },
            variant() {
                return this.$store.getters.variant;
            }
        },
        methods: {
            setFeatured(asset) {
                this.featured = asset;
            },
            getAssets() {
                /* Hides variant Images
                if (this.product.variant_count > 1) {
                    return _.filter(this.product.assets.data, function (item) {
                        return item.kind != 'image';
                    });
                }*/
                return this.product.assets.data;
            },
            getThumbnail() {
                return this.current;
            },
            getTransform(asset, type) {
                let transforms = asset.transforms.data;
                let thumbnail = asset.url;

                let transform = _.find(transforms, item => {
                    return item.handle == type;
                });

                if (transform) {
                    thumbnail = transform.url;
                }

                return thumbnail;
            },
            youtubeEmbed(url) {
                return url.replace("watch?v=", "embed/");
            },
            vimeoEmbed(url) {
                return url.replace("https://vimeo.com/", "https://player.vimeo.com/video/");
            }
        }
    }
</script>
