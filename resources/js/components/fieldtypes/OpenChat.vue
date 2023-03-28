<template>
    <div>
        <div>
            <button v-on:click="toggleChat()" class="btn btn-default">Open chat</button>
        </div>
        <transition>
            <snackbar v-if="snackbar.show" class="toast"
                      :message="snackbar.message"
                      :success="snackbar.success"
            />
        </transition>
        <div v-if="chat.active" class="modal-bg">
            <div class="modal">
                <div class="modal-header flex justify-between">
                    <h4>AI assistant</h4>
                    <i v-on:click="toggleChat()" style="cursor:pointer;height:24px;color:#a10b00">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </i>
                </div>
                <div class="modal-content">
                    <div class="conversation">
                        <div v-for="(message, key) in chat.conversation">
                            <keep-alive>
                                <chat-message
                                    :message="message"
                                    :key="key"
                                    :conversationLength="chat.conversation.length"
                                    v-on:copy="copyMessage(key)"
                                />
                            </keep-alive>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form @submit.prevent="sendChat()">
                        <input type="text" v-model="chat.input" class="chat-input" :disabled="chat.sending">
                        <button type="submit" class="chat-button" :disabled="chat.sending">
                            {{ chat.sending ? 'Waiting' : 'Submit' }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
const axios = require('axios');
import ChatMessage from '../ChatMessage.vue';
import Snackbar from "../Snackbar.vue";

export default {
    mixins: [Fieldtype],
    components: {
        Snackbar,
        'chat-message': ChatMessage
    },
    data() {
        return {
            chat: {
                active: false,
                input: null,
                conversation: [],
                sending: false,
            },
            copied: null,
            snackbar: {
                show: false,
                message: null,
                success: false,
            }
        };
    },
    created() {
        this.binding = this.$keys.bind('alt+g', () => this.toggleChat());
    },
    destroyed() {
        this.binding.destroy();
    },
    methods: {
        toggleChat() {
            this.chat.active = !this.chat.active;
            this.scrollDown(true);
        },
        sendChat() {
            this.chat.sending = true;
            this.chat.conversation.push({
                role: 'user',
                content: this.chat.input
            });

            setTimeout(() => this.scrollDown(true), 50);

            this.chat.input = null;

            axios.post('/cp/api/chat', {
                in: this.chat.conversation
            }).then(res => {
                if(res.data.message.error) {
                    this.popSnack(res.data.message.error.message, false, 5000);
                    return;
                }
                this.chat.sending = false;
                this.chat.conversation.push(
                    {
                        role: 'assistant',
                        content: res.data.message.choices[0].message.content
                    }
                );

                setTimeout(() => this.scrollDown(true), 100);
            });
        }, scrollDown(smooth) {
            const el = document.getElementById('lastMessage');

            if (!el) {
                return
            }

            let options = {}
            if (smooth) {
                options.behavior = 'smooth';
            }

            el.scrollIntoView(options);
        },
        copyMessage(key) {
            navigator.clipboard.writeText(this.chat.conversation[key].content);
            this.popSnack("Text copied!");
        },
        popSnack(message, success = true, time = 2000) {
            this.snackbar.message = message
            this.snackbar.show = true;
            this.snackbar.success = success;
            setTimeout(()=> this.snackbar.show = false, time);
        }
    }
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
.toast {
    position:fixed;
    z-index: 999999;
    bottom:20px;
    width:400px;
    left:calc(50vw - 200px);
}

.modal {
    position: relative;
    width: 96%;
    max-width: 1000px;
    margin: 100px auto 0 auto;
    height: calc(100vh - 148px);
    background-color: white;
    border-radius: 12px;
}

.modal-content {
}

.modal-bg {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.6);
    height: 100vh;
    width: 100vw;
    z-index: 100;
}

.modal-footer {
    position: absolute;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.10);
    width: 100%;
    height: 70px;
}

.modal-header h4 {
    font-size: large;
}

.modal-header {
    height: 46px;
    padding: 16px 24px;
}

.conversation {
    height: calc(100vh - 270px);
    overflow-y: auto;
    padding: 8px 16px;
}

.chat-input {
    width: calc(100% - 32px);
    margin: 16px 0 16px 16px;
    border: 1px rgba(0, 0, 0, 0.10) solid;
    border-radius: 4px;
    padding-right: 96px;
    padding-left: 16px;
    height: 38px;
    box-shadow: rgba(0, 0, 0, 0.35) 0 5px 15px;
}

.chat-button {
    width: 80px;
    margin-left: -80px;
    border-left: solid 1px #4FB4D7;
}
</style>
