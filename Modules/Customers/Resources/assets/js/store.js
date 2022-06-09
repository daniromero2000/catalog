import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        skip: "",
        epss: [],
        isBusy: false,
        cities: [],
        genres: [],
        customer: [],
        housings: [],
        stratums: [],
        customers: [],
        professions: [],
        scholarities: [],
        vehicleTypes: [],
        currentStatus: [],
        relationships: [],
        civilStatuses: [],
        vehicleBrands: [],
        identityTypes: [],
        economicActivity: []
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
        listRelationships(state, relationships) {
            state.relationships = relationships;
        },
        listCivilStatuses(state, civilStatuses) {
            state.civilStatuses = civilStatuses;
        },
        listGenres(state, genres) {
            state.genres = genres;
        },
        listScholarities(state, scholarities) {
            state.scholarities = scholarities;
        },
        listProfessions(state, professions) {
            state.professions = professions;
        },
        listVehicleTypes(state, vehicleTypes) {
            state.vehicleTypes = vehicleTypes;
        },
        listVehicleBrands(state, vehicleBrands) {
            state.vehicleBrands = vehicleBrands;
        },
        listIdentityTypes(state, identityTypes) {
            state.identityTypes = identityTypes;
        },
        listHousings(state, housings) {
            state.housings = housings;
        },
        listStratums(state, stratums) {
            state.stratums = stratums;
        },
        listEps(state, epss) {
            state.epss = epss;
        },
        addNewPhone(state, newPhone) {
            state.customer.customer_phones.push(newPhone);
        },
    },
    actions: {
        storeComment(context, newComment) {
            axios.post("/admin/customer-commentaries", newComment).then(response => {
                if (response.data) {
                    newComment = "";
                }
            });
        },
        storeEmail(context, newEmail) {
            axios.post("/admin/customer-emails", newEmail).then(response => {
                if (response.data) {
                    newEmail = "";
                }
            });
        },
        storeEps(context, newEps) {
            axios.post("/admin/customer-epss", newEps).then(response => {
                if (response.data) {
                    // context.commit("addNewEps", newEps);
                    newEps = "";
                }
            });
        },
        storePhone(context, newPhone) {
            axios.post("/admin/customer-phones", newPhone).then(response => {
                if (response.data) {
                    context.commit("addNewPhone", newPhone);
                    newPhone = "";
                }
            });
        },
        storeAddress(context, newAddress) {
            axios.post("/admin/customer-addresses", newAddress).then(response => {
                if (response.data) {
                    // context.commit("addNewAddress", newAddress);
                    newAddress = "";
                }
            });
        },
        storeEconomicActivity(context, newEconomicActivity) {
            axios.post("/admin/customer-economic-activities", newEconomicActivity).then(response => {
                if (response.data) {
                    // context.commit("addNewEconomicActivity", newEconomicActivity);
                    newEconomicActivity = "";
                }
            });
        },
        storeVehicle(context, newVehicle) {
            axios.post("/admin/customer-vehicles", newVehicle).then(response => {
                if (response.data) {
                    // context.commit("addNewVehicle", newVehicle);
                    newVehicle = "";
                }
            });
        },
        storeIdentification(context, newIdentification) {
            axios.post("/admin/customer-identities", newIdentification).then(response => {
                if (response.data) {
                    // context.commit("addNewIdentification", newIdentification);
                    newIdentification = "";
                }
            });
        },
        storeProfession(context, newProfessions) {
            axios.post("/admin/customer-professions", newProfessions).then(response => {
                if (response.data) {
                    // context.commit("addNewProfessions", newProfessions);
                    newProfessions = "";
                }
            });
        },
        storeReference(context, newReference) {
            axios.post("/admin/customer-references", newReference).then(response => {
                if (response.data) {
                    // context.commit("addNewReference", newReference);
                    newReference = "";
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
        getRelationships(context) {
            axios.get("/admin/api/listRelationships").then(response => {
                context.commit("listRelationships", response.data.relationships);
            });
        },
        getCivilStatuses(context) {
            axios.get("/admin/api/listCivilStatuses").then(response => {
                context.commit("listCivilStatuses", response.data.civil_statuses);
            });
        },
        getGenres(context) {
            axios.get("/admin/api/listGenres").then(response => {
                context.commit("listGenres", response.data.genres);
            });
        },
        getScholarities(context) {
            axios.get("/admin/api/listScholarities").then(response => {
                context.commit("listScholarities", response.data.scholarities);
            });
        },
        getVehicles(context) {
            axios.get("/admin/api/listVehicles").then(response => {
                context.commit("listVehicleTypes", response.data.vehicle_types);
                context.commit("listVehicleBrands", response.data.vehicle_brands);
            });
        },
        getIdentityTypes(context) {
            axios.get("/admin/api/listIdentityTypes").then(response => {
                context.commit("listIdentityTypes", response.data.identity_types);
            });
        },
        getHousings(context) {
            axios.get("/admin/api/listHousings").then(response => {
                context.commit("listHousings", response.data.housings);
            });
        },
        getStratums(context) {
            axios.get("/admin/api/listStratums").then(response => {
                context.commit("listStratums", response.data.stratums);
            });
        },
        getEps(context) {
            axios.get("/admin/api/listEps").then(response => {
                context.commit("listEps", response.data.epss);
            });
        }
    },
    // getters: {
    //     listEconomicActivity(state) {
    //         return state.conversations.filter(conversation => {
    //             return (
    //                 !state.querySearch ||
    //                 conversation.contact_name
    //                     .toLowerCase()
    //                     .indexOf(state.querySearch.toLowerCase()) > -1
    //             );
    //         });
    //     }
    // }
});
