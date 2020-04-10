const algoliasearch = require('algoliasearch/lite');
const instantsearch = require('instantsearch.js').default;
import { connectAutocomplete } from 'instantsearch.js/es/connectors';
import Tagify from '@yaireo/tagify';

const settings = {
    search: {
        delimiters: ',| ',
        enforceWhitelist: true,
        dropdown: {
            mapValueTo: 'value',
            searchKeys: ['bold'],
        }
    },
    create: {
        delimiters: ',| ',
        keepInvalidTags: true,
        dropdown: {
            mapValueTo: 'value',
            searchKeys: ['bold'],
        }
    }
};

const stripCharacters = {'đ': 'dj', 'ž': 'z', 'ć': 'c', 'č': 'c', 'š': 's'};


export default class Tags {
    constructor (input, autocompleteContainer, output) {
        this.search = instantsearch({
            indexName: 'tags',
            searchClient: algoliasearch(
                ALGOLIA_APP_ID,
                ALGOLIA_PUBLIC_SECRET
            ),
        });

        this.input = input;
        this.autocompleteContainer = autocompleteContainer;
        this.output = output;
        this.settingsType = this.input.dataset.type === 'create' ? 'create' : 'search';

        this.tags = {};

        this.init()
    }

    init () {
        const initialTags = this.output.value;
        const whitelist = initialTags ? initialTags.split(' ').map(el => ({value: el.toLowerCase(), bold: el.toLowerCase().replace(/[ćčšđž]/g, m => stripCharacters[m])})) : [];

        this.tagify = new Tagify(
            this.input,
            { ...settings[this.settingsType], whitelist },
        );

        // Create the custom widget
        this.customAutocomplete = connectAutocomplete(
            this.renderAutocomplete.bind(this)
        );

        // Instantiate the custom widget
        this.search.addWidgets([
            this.customAutocomplete({
                container: this.autocompleteContainer,
            })
        ]);

        this.search.start();
    }

    // Create the render function
    renderAutocomplete (renderOptions, isFirstRender) {
        const {indices, currentRefinement, refine} = renderOptions;

        if (isFirstRender) {
            this.tagify.on('input', e => {
                if (e.detail.value.length > 2) {
                    refine(e.detail.value);
                }
            });
            this.tagify.on('add remove', e => {
                this.output.value = this.tagify.value.map(tag => tag.value).join(' ');
            });
        }

        if (currentRefinement && indices.length) {
            let whitelist = indices[0].hits.map(el => ({value: el.name.toLowerCase(), bold: el.bold.toLowerCase()}));
            // remove duplicates
            whitelist = [...new Map(whitelist.map(item => [item.value, item])).values()];

            this.tagify.settings.whitelist.splice(0, this.tagify.settings.whitelist.length, ...whitelist);
            const stripedValue = currentRefinement.toLowerCase().replace(/[ćčšđž]/g, m => stripCharacters[m]);

            this.tagify.loading(false).dropdown.show.call(this.tagify, stripedValue);
        }
    };
}
