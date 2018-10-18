<template>
    <div class="variations">
        <div class="form-group">
            <label v-for="(optionData, optionDataName) in options" :key="optionDataName" style="display:block;">
                <span class="list-label">{{ optionData.label.en }}</span>
                <span class="custom-select">
                    <select class="form-control custom-dropdown" v-model="setSelected">
                        <option v-for="option in optionData.options" :key="option.values.en" :value="{[optionDataName]:option.values}">
                            {{ option.values.en }}
                        </option>
                    </select>
                </span>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Object,
                default: {}
            },
            variants: {
                type: Object,
                default: {}
            }
        },
        data() {
            return {
                selected: {}
            }
        },
        created() {
            this.selected = this.$store.state.product.variant.options;
        },
        computed: {
            setSelected: {
                get () {
                    return this.selected;
                },
                set (value) {
                    this.$set(this.selected, Object.keys(value)[0], value[Object.keys(value)[0]]);
                    this.$store.commit('setProductVariant', Candy.mapVariant(this.variants, this.selected));
                }
            }
        }
    }
</script>
