import OpenChat from './components/fieldtypes/OpenChat.vue';

Statamic.booting( () => {
    Statamic.$components.register('open_chat-fieldtype', OpenChat);
})
