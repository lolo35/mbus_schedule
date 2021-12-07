export default {
    namespaced: true,
    state: {
        routes: [
            {
                route: "OMV",
                stations: [ 
                    {
                        name: "OMV",
                        tur: {
                            'sch1': '05:33',
                            'sch2': '14:03',
                            'sch3': '22:33'
                        }
                    },
                    {
                        name: "Int. Primaverii/Closca",
                        tur: {
                            'sch1': '05:35',
                            'sch2': '15:05',
                            'sch3': '22:35'
                        }
                    },
                    {
                        name: "Troita Timisului/Caraiman",
                        tur: {
                            'sch1': '05:40',
                            'sch2': '14:10',
                            'sch3': '22:40'
                        }
                    },
                    {
                        name: "Int. Aurel Vlaicu/Caraiman",
                        tur: {
                            'sch1': '05:42',
                            'sch2': '14:12',
                            'sch3': '22:42'
                        }
                    },
                    {
                        name: "Int. Tapiei/Casian Munteanu",
                        tur: {
                            'sch1': '05:43',
                            'sch2': '14:13',
                            'sch3': '22:43',
                        }
                    },
                    {
                        name: "Autoliv",
                        tur: {
                            'sch1': '05:45',
                            'sch2': '14:15',
                            'sch3': '22:45',
                        }
                    }
                ],
            },
            {
                route: "Cotul Mic",
                stations: [
                    {
                        name: "Parcul George Enescu",
                        tur: {
                            'sch1': '05:22',
                            'sch2': '13:52',
                            'sch3': '22:22'
                        },
                        retur: {
                            'sch1': '06:38',
                            'sch2': '15:08',
                            'sch3': '23:38'
                        }
                    },
                    {
                        name: "Favisan",
                        tur: {
                            'sch1': '05:25',
                            'sch2': '13:55',
                            'sch3': '22:25',
                        },
                        retur: {
                            'sch1': '06:35',
                            'sch2': '15:05',
                            'sch3': '23:35',
                        }
                    },
                    {
                        name: "Pasarela Cotul Mic",
                        tur: {
                            'sch1': '05:27',
                            'sch2': '13:57',
                            'sch3': '22:27',
                        },
                        retur: {
                            'sch1': '06:33',
                            'sch2': '15:03',
                            'sch3': '23:03'
                        }
                    },
                    {
                        name: "Int. Str. Viorelelor/Ghe.Doja",
                        tur: {
                            'sch1': '05:29',
                            'sch2': '13:59',
                            'sch3': '22:29'
                        },
                        retur: {
                            'sch1': '06:31',
                            'sch2': '15:01',
                            'sch3': '23:31'
                        }
                    },
                    {
                        name: "Autoliv",
                        tur: {
                            'sch1': '05:45',
                            'sch2': '14:15',
                            'sch3': '22:45'
                        },
                        retur: {
                            'sch1': '06:15',
                            'sch2': '14:45',
                            'sch3': '23:15'
                        }
                    }
                ]
            },
            {
                route: "Bruma",
                stations: [
                    {
                        name: "Unicarm",
                        tur: {
                            'sch1': '05:33',
                            'sch2': '14:03',
                            'sch3': '22:33',
                        },
                    },
                    {
                        name: "Petrom Fagetului",
                        tur: {
                            'sch1': '05:38',
                            'sch2': '14:08',
                            'sch3': '22:38'
                        }
                    },
                    {
                        name: "Cimitir Fagetului",
                        tur: {
                            'sch1': '05:40',
                            'sch2': '14:40',
                            'sch3': '22:40',
                        }
                    },
                    {
                        name: "Autoliv",
                        tur: {
                            'sch1': '05:45',
                            'sch2': '14:15',
                            'sch3': '22:45',
                        }
                    }
                ]
            }
        ]
    },
    mutations: {

    },
    actions: {

    }
}