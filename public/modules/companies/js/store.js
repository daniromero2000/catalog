import Vuex from 'vuex'
import Vue from 'vue'


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        customer: [],
        customers: [],
        currentStatus: [],
        skip: "",
        isBusy: false,
        economicActivity: [],
        professions: [],
        cities: []
    },
    mutations: {
        customer(state, customer) {
            state.customer = customer;
        },
        currentStatus(state, currentStatus) {
            state.currentStatus = currentStatus;
        },
        customerList(state, customers) {
            state.customers = customers;
        },
        vauleSkip(state, skip) {
            state.skip = skip;
        },
        toggleBusy(state, isBusy) {
            state.isBusy = isBusy;
        },
        listEconomicActivity(state, economicActivity) {
            state.economicActivity = economicActivity;
        },
        listProfessions(state, professions) {
            state.professions = professions;
        },
        listCities(state, cities) {
            state.cities = cities;
        },
        addNewEconomicActivity(state, newEconomicActivity) {
            state.customer.customer_economic_activities.push(newEconomicActivity);
        },
    },
    actions: {
        storeEconomicActivity(context, newEconomicActivity) {
            axios.post("/admin/customer-economic-activities", newEconomicActivity).then(response => {
                if (response.data) {
                    context.commit("addNewEconomicActivity", newEconomicActivity);
                    newEconomicActivity = "";
                }
            });
        },
        getCustomers(context) {
            axios.get("/admin/api/customers?skip=" + context.state.skip).then(response => {
                context.commit("customerList", response.data.customers);
            });
        },
        getCustomersFiltered(context, form) {
            axios.get("/admin/api/customers?q=" + form.search + "&from=" + form.from + "&to=" + form.to).then(response => {
                context.commit("customerList", response.data.customers);
            });
        },
        getCustomerForId(context, id) {
            axios.get("/admin/api/customers/" + id).then(response => {
                context.commit("customer", response.data.customer);
                context.commit("currentStatus", response.data.currentStatus);

            });
        },
        getlistEconomicActivity(context) {
            axios.get("/admin/api/listEconomicActivity").then(response => {
                context.commit("listEconomicActivity", response.data.economic_activity_types);
                context.commit("listProfessions", response.data.professions_lists);
            });
        },
        getListCities(context) {
            axios.get("/admin/api/listCities").then(response => {
                context.commit("listCities", response.data.cities);
            });
        },
    },
    getters: {
        listEconomicActivity(state) {
            return state.conversations.filter(conversation => {
                return (
                    !state.querySearch ||
                    conversation.contact_name
                        .toLowerCase()
                        .indexOf(state.querySearch.toLowerCase()) > -1
                );
            });
        }
    }
});
