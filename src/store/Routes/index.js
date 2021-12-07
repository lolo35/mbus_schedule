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
            },
            {
                route: "Extra",
                stations: [
                    {
                        name: "Mondialul Bocsei",
                        tur: {
                            'sch1': '04:50',
                            'sch2': '13:20',
                            'sch3': '21:50',
                        }
                    },
                    {
                        name: "Bocsei Radulescu",
                        tur: {
                            'sch1': '04:53',
                            'sch2': '13:23',
                            'sch3': '21:53'
                        }
                    },
                    {
                        name: "Cartier Dragan(ITL)",
                        tur: {
                            'sch1': '05:00',
                            'sch2': '13:30',
                            'sch3': '22:00'
                        }
                    },
                    {
                        name: "Magazin Ambient",
                        tur: {
                            'sch1': '05:01',
                            'sch2': '13:31',
                            'sch3': '22:01',
                        }
                    },
                    {
                        name: "Bariera Bocsei",
                        tur: {
                            'sch1': '05:05',
                            'sch2': '13:35',
                            'sch3': '22:05',
                        }
                    },
                    {
                        name: "Petrom Caransebesului",
                        tur: {
                            'sch1': '05:10',
                            'sch2': '13:40',
                            'sch3': '22:10'
                        }
                    },
                    {
                        name: "Mol",
                        tur: {
                            'sch1': '05:11',
                            'sch2': '13:41',
                            'sch3': '22:11'
                        }
                    },
                    {
                        name: "Catedrala Ortodoxa",
                        tur: {
                            'sch1': '05:12',
                            'sch2': '13:42',
                            'sch3': '22:12'
                        }
                    },
                    {
                        name: "Liliacul",
                        tur: {
                            'sch1': '05:14',
                            'sch2': '13:44',
                            'sch3': '22:14'
                        }
                    },
                    {
                        name: "Parcul George Enescu",
                        tur: {
                            'sch1': '05:16',
                            'sch2': '13:46',
                            'sch3': '22:16'
                        }
                    },
                    {
                        name: "Pasarela Cotul Mic",
                        tur: {
                            'sch1': '05:20',
                            'sch2': '13:50',
                            'sch3': '22:20'
                        }
                    },
                    {
                        name: "OMV",
                        tur: {
                            'sch1': '05:24',
                            'sch2': '13:54',
                            'sch3': '22:24'
                        }
                    },
                    {
                        name: "Sala Sportului",
                        tur: {
                            'sch1': '05:25',
                            'sch2': '13:55',
                            'sch3': '22:25'
                        }
                    },
                    {
                        name: "Parcare Taxi Unic",
                        tur: {
                            'sch1': '05:28',
                            'sch2': '13:58',
                            'sch3': '22:28'
                        }
                    },
                    {
                        name: "Bruma",
                        tur: {
                            'sch1': '05:29',
                            'sch2': '13:59',
                            'sch3': '22:20'
                        }
                    },
                    {
                        name: "Petrom Fagetului",
                        tur: {
                            'sch1': '05:32',
                            'sch2': '14:02',
                            'sch3': '22:32'
                        }
                    },
                    {
                        name: "Troita Timisului/Caraiman",
                        tur: {
                            'sch1': '05:35',
                            'sch2': '14:05',
                            'sch3': '22:35'
                        }
                    },
                    {
                        name: "Pod Caraiman",
                        tur: {
                            'sch1': '05:36',
                            'sch2': '14:06',
                            'sch3': '22:36'
                        }
                    },
                    {
                        name: "Cimitir Fagetului",
                        tur: {
                            'sch1': '05:38',
                            'sch2': '14:08',
                            'sch3': '22:38'
                        }
                    },
                    {
                        name: "Pompieri Fagetului",
                        tur: {
                            'sch1': '05:40',
                            'sch2': '14:10',
                            'sch3': '22:40'
                        }
                    },
                    {
                        name: "Autoliv",
                        tur: {
                            'sch1': '05:45',
                            'sch2': '14:15',
                            'sch3': '22:45'
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