<template>
    <div>
        <form class="d-flex justify-content-end" method="get" action="">
            <div class="form-inline mb-2">
                <div class="form-check-inline">
                    <input name="unregistered" v-model="filters.unregistered" type="checkbox"
                           class="form-check-input m-1" value="true">
                    <label for="unregistered" class="form-check-label">N</label>
                </div>
                <div class="form-check-inline">
                    <input name="cash_register" v-model="filters.cash_register" type="checkbox"
                           class="form-check-input m-1" value="true">
                    <label for="cash_register" class="form-check-label">K</label>
                </div>
                <div class="form-check-inline">
                    <input name="terminal" v-model="filters.terminal" type="checkbox"
                           class="form-check-input m-1" value="true">
                    <label for="terminal" class="form-check-label">T</label>
                </div>
                <div class="form-check-inline">
                    <input name="voucher" v-model="filters.voucher" type="checkbox"
                           class="form-check-input m-1" value="true">
                    <label for="voucher" class="form-check-label">B</label>
                </div>
                <div class="form-check-inline">
                    <input name="invoice" v-model="filters.invoice" type="checkbox"
                           class="form-check-input m-1" value="true">
                    <label for="invoice" class="form-check-label">F</label>
                </div>
                <input v-model="filters.departure_date" name="departure_date" type="date"
                       class="form-control form-control-sm m-1" placeholder="Data odjazdu">
                <select v-model="filters.status" name="status" type="select"
                        class="form-control form-control-sm m-1">
                    <option value="">Wszystkie</option>
                    <option value="unsettled">Nierozliczono</option>
                    <option value="settled">Rozliczono</option>
                </select>
                <input v-model="filters.query" type="text" class="form-control form-control-sm m-1" name="query"
                       list="client-names" placeholder="Szukaj">
                <datalist id="client-names">
                    <option v-for="name in clientNames" :value="name">{{ name }}</option>
                </datalist>
                <button type="submit" class="btn btn-primary btn-sm m-1">Szukaj</button>
            </div>
        </form>
        <div class="row border" v-for="client in clients.data" type="button" :data-target="'#collapse-' + client.id"
             data-toggle="collapse"
             aria-expanded="false" :aria-controls="'collapse-' + client.id">
            <div class="col-12">
                <div class="row no-gutters">
                    <div class="col p-2">
                        <div class="row">
                            <div class="col-12 col-sm">
                                <b>#{{ client.id }} {{ client.name }}</b>
                            </div>
                            <div class="col-12 col-sm text-left text-sm-right">
                                <b v-if="client.status === 'settled'">Rozliczono</b>
                                <b v-if="client.unregistered === 1">N</b><b v-if="client.cash_register === 1">K</b><b v-if="client.terminal === 1">T</b><b v-if="client.voucher === 1">B</b><b v-if="client.invoice === 1">F</b>
                            </div>
                        </div>
                        <div>
                            {{ client.arrival_date ? client.arrival_date : '?' }} -
                            {{ client.departure_date ? client.departure_date : '?' }}
                        </div>
                    </div>
                    <div class="col-3 col-sm-2 border-left">
                        <div class="row no-gutters text-center">
                            <div class="col-12 p-1">
                                <a class="btn btn-primary"
                                   :href="'clients/edit/' + client.id">
                                    <i class="far fa-fw fa-sticky-note"></i>
                                </a>
                            </div>
                            <form @submit.prevent="showDeleteDialog(client.id)" method="POST" action=""
                                  class="col-12 p-1 m-0">
                                <button class="btn btn-danger">
                                    <i class="far fa-fw fa-trash-alt"></i>
                                </button>
                            </form>
                            <div class="col-12 p-1">
                                <a @click="showSettleModal(client)"
                                   class="btn btn-warning text-light">
                                    <i class="fas fa-fw fa-dollar-sign"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <v-dialog></v-dialog>
                </div>
                <div class="collapse row border-top p-3" :id="'collapse-' + client.id">
                    <div class="col-12 col-sm-6 col-lg-3 mb-1" v-for="category in categories">
                        <div>
                            <b>{{ category.name }}</b>
                            <div v-for="item in client.client_items"
                                 v-if="item.service_category && item.service_category.name === category.name">
                                {{ item.count }} x {{ item.name }} {{ item.price }} zł
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div>
                            <b>Suma: {{ client.price }} zł <span v-if="client.paid > 0">(zapłacono {{
                                    client.paid
                                }} zł)</span></b>
                        </div>
                        <div>
                            <b>Klimatyczne: {{ client.climate_price }} zł <span
                                v-if="client.climate_paid > 0">(zapłacono {{ client.climate_paid }} zł)</span></b>
                        </div>
                        <div>
                            <b>Razem: {{ client.price + client.climate_price }} zł <span
                                v-if="client.paid + client.climate_paid> 0">(zapłacono {{
                                    client.paid + client.climate_paid
                                }} zł)</span></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SettleModal from "./SettleModal";

export default {
    props: ['clients', 'filters', 'clientNames'],
    methods:
        {
            showSettleModal(client) {
                this.$modal.show(SettleModal,
                    {
                        client: client,
                        categories: this.categories,
                    },
                    {
                        name: 'settle-modal',
                        adaptive: true,
                        reset: true,
                        focusTrap: true,
                        height: "auto",
                        width: 400
                    });
            },
            showDeleteDialog(id) {
                this.$modal.show('dialog', {
                    title: 'Uwaga!',
                    text: 'Czy na pewno chcesz usunąć wpis #' + id + "?",
                    buttons: [
                        {
                            title: 'Nie',
                            handler: () => {
                                this.$modal.hide('dialog')
                            }
                        },
                        {
                            title: 'Tak',
                            handler: () => {
                                this.deleteClient(id);
                                this.$modal.hide('dialog')
                            }
                        }
                    ]
                })
            },
            deleteClient: function (id) {
                axios.delete(baseUrl + '/api/clients/' + id)
                    .then(() => {
                        window.location.reload()
                    });
            },
            groupItems(client) {
                let items = client.client_items;
                for (let i = 0; i < items.length; i++) {
                    for (let j = i + 1; j < items.length; j++) {
                        if (items[i].name === items[j].name && items[i].price === items[j].price) {
                            items[i].count += items[j].count;
                            items.splice(j, 1);
                            j--;
                        }
                    }
                }
            },
        },
    mounted() {
        axios.get(baseUrl + '/api/categories?service_id=1')
            .then((response) => {
                this.categories = response.data;
            });
        this.clients.data.forEach(function (client) {
            this.groupItems(client)
        }, this);
    },
    data: function () {
        return {
            categories: null,
        }
    }
}
</script>
