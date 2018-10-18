<template>
    <div>
        <div :class="['modal','animated','animatedFast',effect]" :id="id" tabindex="-1" role="dialog" :aria-labelledby="id">
            <div :class="['modal-dialog',size]" role="document">
                <div class="modal-content">
                    <slot name="body"></slot>
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
        <div :class="['modal-backdrop','in','animated','animatedFast',backdropEffect]"></div>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                default: 'my-modal',
                type: String
            },
            title: {
                default: 'My Modal',
                type: String
            },
            size: {
                default: 'modal-lg',
                type: String
            }
        },
        data () {
            return {
                effect: 'fadeIn',
                backdropEffect: 'fadeInBack'
            }
        },
        methods: {
            closeModal: function () {
                this.effect = 'fadeOut';
                this.backdropEffect = 'fadeOutBack';
                var $this = this;
                setTimeout(function(){
                    $this.$emit('closed');
                    $this.effect = 'fadeIn';
                    $this.backdropEffect = 'fadeInBack';
                }, 500);
            },
        }
    }
</script>

<style scoped>
    .modal {
        display: block;
    }

    .animatedFast {
        -webkit-animation-duration: 0.5s;
        animation-duration: 0.5s;
    }

    @keyframes fadeInBack {
        from {
            opacity: 0;
        }

        to {
            opacity: 0.8;
        }
    }

    .fadeInBack {
        animation-name: fadeInBack;
    }

    @keyframes fadeOutBack {
        from {
            opacity: 0.8;
        }

        to {
            opacity: 0;
        }
    }

    .fadeOutBack {
        animation-name: fadeOutBack;
    }
</style>
