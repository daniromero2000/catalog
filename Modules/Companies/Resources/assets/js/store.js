import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        notifications: []
    },
    mutations: {
        notificationList(state, notifications) {
            state.notifications = notifications;
        },
        addNotification(state, notification) {
            state.notifications.push(notification);
        },
        deleteNotification(state, notification) {
            for (let index = 0; index < state.notifications.length; index++) {
                if (state.notifications[index].id == notification){
                    state.notifications.splice(index, 1)
                }
            }
        },
    },
    actions: {
        deleteNotification(context, notification) {
            context.commit("deleteNotification", notification);
            axios.post("/admin/deleteNotification/" + notification).then(response => {
                notification = "";
            });
        },
        saveNotification(context, newnotification) {
            axios.post("/admin/saveNotification", newnotification).then(response => {
                if (response.data) {
                    context.commit("addNotification", response.data);
                    newnotification = "";
                }
            });
        },
        getNotifications(context) {
            axios.get("/admin/getNotifications").then(response => {
                context.commit("notificationList", response.data);
            });
        },
    },
});
