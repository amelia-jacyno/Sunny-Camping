<template>
    <div id="client-form" class="row mt-4">
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="name">Imię i nazwisko</label>
            <input
                id="name"
                v-model.trim="client.name"
                :class="{ 'is-invalid': isNameInvalid }"
                @input="isNameInvalid = false"
                name="name"
                type="text" placeholder="Imię i nazwisko"
                class="form-control form-control-sm"
            >
            <div class="invalid-feedback">
                Imię i nazwisko muszą być podane!
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="arrival_date">Data przyjazdu</label>
            <input id="arrival_date" v-model="client.arrival_date" name="arrival_date" type="date"
                   class="form-control form-control-sm">
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="departure_date">Data odjazdu</label>
            <input id="departure_date" v-model="client.departure_date" name="departure_date" type="date"
                   class="form-control form-control-sm">
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="car_registration">Rejestracja</label>
            <input
                id="car_registration"
                v-model.trim="client.car_registration"
                name="car_registration"
                type="text"
                placeholder="Rejestracja"
                class="form-control form-control-sm"
            >
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="discount">Rabat</label>
            <select id="discount" v-model="client.discount" name="discount" class="custom-select custom-select-sm">
                <option :value="0">0%</option>
                <option :value="5">5%</option>
                <option :value="10">10%</option>
            </select>
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="paid">Zapłacono</label>
            <input
                id="paid"
                v-model.number="client.paid"
                name="paid"
                type="number"
                placeholder="0"
                class="form-control form-control-sm"
                :class="{ 'is-invalid': isSettledWithoutPaid }"
                @input="isSettledWithoutPaid = false"
            >
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="climate_paid">Klimatyczne</label>
            <input
                id="climate_paid"
                v-model.number="client.climate_paid"
                name="paid"
                type="number"
                placeholder="0"
                class="form-control form-control-sm"
            >
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="token_number">Token</label>
            <input id="token_number" v-model="client.token_number" name="token_number" type="number"
                   class="form-control form-control-sm">
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="status">Status</label>
            <select
                id="status"
                class="form-control form-control-sm"
                v-model="client.status"
                :class="{ 'is-invalid': isSettledWithoutPaid }"
                @change="isSettledWithoutPaid = false"
            >
                <option value="unsettled">Nierozliczono</option>
                <option value="settled">Rozliczono</option>
            </select>
            <div class="invalid-feedback">
                Nie można wybrać "Rozliczono" bez wpisania zapłaconej ilości!
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="sector">Sektor</label>
            <input id="sector" v-model="client.sector" name="sector" type="text" placeholder="Sektor"
                   class="form-control form-control-sm">
        </div>
        <div class="col-6 col-sm-4 col-md-3 form-group">
            <label for="comment">Komentarz</label>
            <input
                id="comment"
                v-model.trim="client.comment"
                name="comment"
                type="text"
                placeholder="Komentarz"
                class="form-control form-control-sm"
            >
        </div>
        <div class="col-12">
            <div class="form-check-inline">
                <input id="unregistered" v-model="client.unregistered" type="checkbox"
                       class="form-check-input">
                <label for="unregistered" class="form-check-label">N</label>
            </div>
            <div class="form-check-inline">
                <input id="cash-register" v-model="client.cash_register" type="checkbox"
                       class="form-check-input">
                <label for="cash-register" class="form-check-label">K</label>
            </div>
            <div class="form-check-inline">
                <input id="terminal" v-model="client.terminal" type="checkbox"
                       class="form-check-input">
                <label for="terminal" class="form-check-label">T</label>
            </div>
            <div class="form-check-inline">
                <input id="voucher" v-model="client.voucher" type="checkbox"
                       class="form-check-input">
                <label for="voucher" class="form-check-label">B</label>
            </div>
            <div class="form-check-inline">
                <input id="invoice" v-model="client.invoice" type="checkbox"
                       class="form-check-input">
                <label for="invoice" class="form-check-label">F</label>
            </div>
        </div>
        <div class="col-12 text-center">
            <div>
                <b>Suma: {{ price }} zł <span v-if="client.paid > 0">
                    (pozostało {{ Math.max(0, price - client.paid) }} zł)
                </span></b>
            </div>
            <div>
                <b>Klimatyczne: {{ climate_price }} zł <span v-if="client.climate_paid > 0">
                    (pozostało {{ Math.max(0, climate_price - client.climate_paid) }} zł)
                </span></b>
            </div>
            <div>
                <b>Razem: {{ price + climate_price }} zł <span v-if="client.paid + client.climate_paid> 0">
                    (pozostało {{ Math.max(0, price + climate_price - client.paid - client.climate_paid) }} zł)
                </span></b>
            </div>
        </div>
        <div class="col-12">
            <hr>
            <div v-for="(category, index) in categories" :key="category.id" class="row">
                <div class="col-12">
                    <h2>{{ category.name }}</h2>
                    <div class="mb-3">
                        <a v-for="item in category.service_category_items" :key="item.id" @click="addItem(index, item)"
                           class="btn btn-primary mx-1">{{ item.name }}</a>
                    </div>
                    <div class="row no-gutters" v-for="(item, itemIndex) in category.addedItems">
                        <div class="col-12 col-md-2 d-flex justify-content-md-center align-items-md-center">
                            <b>{{ item.name }}</b>
                        </div>
                        <div class="col-3 col-md-2 px-1 px-md-2 form-group">
                            <label>Cena</label>
                            <input v-model="item.price" type="number"
                                   class="form-control form-control-sm">
                        </div>
                        <div class="col-3 col-md-2 px-1 px-md-2 form-group">
                            <label>Ilość</label>
                            <input v-model="item.count" type="number"
                                   class="form-control form-control-sm">
                        </div>
                        <div class="col-3 col-md-2 px-1 px-md-2 form-group">
                            <label>Dni</label>
                            <input v-model="item.days" type="number"
                                   class="form-control form-control-sm">
                        </div>
                        <div class="form-group px-1 px-md-2">
                            <label>Usuń</label>
                            <div>
                                <a class="btn btn-danger" @click="deleteItem(index, itemIndex)"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-12 text-center">
            <button @click="submitClientForm()" class="btn btn-success w-50 mb-4">
                Zatwierdź
            </button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['mode', 'id'],
    data() {
        return {
            client: {
                discount: 0,
                client_items: [],
                unregistered: false,
                cash_register: false,
                terminal: false,
                voucher: false,
                invoice: false
            },
            categories: [],
            items: [],
            isNameInvalid: false,
            price: 0,
            climate_price: 0,
            submitting: false,
            isSettledWithoutPaid: false
        }
    },
    mounted() {
        if (this.mode === 'PUT' && this.id != null) {
            axios.get(baseUrl + '/api/clients/' + this.id)
                .then((response) => {
                    this.client = response.data;

                    axios.get(baseUrl + '/api/categories?service_id=1')
                        .then((response) => {
                            let categories = [];
                            response.data.forEach(function (category) {
                                category.addedItems = [];
                                this.client.client_items.forEach(function (item) {
                                    if (category.id === item.service_category_id) {
                                        category.addedItems.push(item);
                                    }
                                })
                                categories.push(category);
                            }, this)
                            this.categories = categories;
                        });
                });
        }
        if (this.mode === 'POST') {
            axios.get(baseUrl + '/api/categories?service_id=1')
                .then((response) => {
                    let categories = [];
                    response.data.forEach(function (category) {
                        category.addedItems = [];
                        this.client.client_items.forEach(function (item) {
                            if (category.id === item.service_category_id) {
                                category.addedItems.push(item);
                            }
                        })
                        categories.push(category);
                    }, this)
                    this.categories = categories;
                });
        }
        this.updateClimatePrice();
        this.updatePrice();
    },
    watch: {
        client: {
            handler() {
                this.updatePrice();
                this.updateClimatePrice();
            },
            deep: true
        },
        categories: {
            handler() {
                this.updatePrice();
                this.updateClimatePrice();
            },
            deep: true
        }
    },
    methods: {
        trim(input) {
            if (input) return input.trim();
            return null;
        },
        addItem(categoryId, item) {
            item.id = null;
            item.count = 1;
            this.categories[categoryId].addedItems.push(Vue.util.extend({}, item));
        },
        deleteItem(categoryId, itemId) {
            this.categories[categoryId].addedItems.splice(itemId, 1);
        },
        submitClientForm() {
            if (this.submitting) {
                return false;
            }

            if (!this.client.name) {
                this.isNameInvalid = true;
                window.scrollTo(0, 0);
                return false;
            }

            if (this.client.status === 'settled' && !this.client.paid)
            {
                this.isSettledWithoutPaid = true;
                window.scrollTo(0, 0);
                return false;
            }

            if (this.client.arrival_date && this.client.departure_date && new Date(this.client.arrival_date) >= new Date(this.client.departure_date)) {
                window.scrollTo(0, 0);
                alert("Data odjazdu musi być później od daty przyjazdu!");
                return false;
            }
            let request;

            this.client.client_items = [];
            this.categories.forEach(function(category) {
                this.client.client_items = this.client.client_items.concat(category.addedItems);
            }, this);

            this.submitting = true;
            if (this.mode === 'POST') {
                request = axios.post(baseUrl + '/api/clients', this.client);
            } else {
                request = axios.put(baseUrl + '/api/clients/' + this.id, this.client);
            }
            request.then(() => {
                window.location.href = baseUrl + '/admin/clients';
            }, () => {
                alert("Coś poszło nie tak! Upewnij się że wpisane dane są poprawne!");
                this.submitting = false;
            });
        },
        getDays() {
            if (!this.client.arrival_date || !this.client.departure_date) {
                return 0;
            }
            const day = 1000 * 60 * 60 * 24;
            const diff = Math.abs(new Date(this.client.arrival_date) - new Date(this.client.departure_date));

            return Math.round(diff / day);
        },
        updatePrice() {
            if (this.days === 0) {
                return 0;
            }

            let price = 0;
            this.categories.forEach(function(category) {
                if (category.name !== 'Klimatyczne') {
                    category.addedItems.forEach(function(item) {
                        let item_price = item.price * item.count;

                        if (category.name === 'Osoby') {
                            item_price *= (100 - this.client.discount) / 100;
                        }

                        if (item.days) {
                            item_price *= item.days;
                        } else {
                            item_price *= this.getDays();
                        }

                        price += item_price;
                    }, this)
                }
            }, this)

            this.price = Math.round(price);
        },
        updateClimatePrice() {
            if (this.days === 0) {
                return 0;
            }

            let price = 0;
            this.categories.forEach(function(category) {
                if (category.name === 'Klimatyczne') {
                    category.addedItems.forEach(function(item) {
                        let item_price = item.price * item.count;

                        if (item.days) {
                            item_price *= item.days;
                        } else {
                            item_price *= this.getDays();
                        }

                        price += item_price;
                    }, this)
                }
            }, this)

            this.climate_price = Math.round(price);
        }
    },
}
</script>
