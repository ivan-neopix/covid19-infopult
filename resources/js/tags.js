const algoliasearch = require('algoliasearch/lite');
const instantsearch = require('instantsearch.js').default;
import { connectAutocomplete } from 'instantsearch.js/es/connectors';
import Tagify from '@yaireo/tagify';

const settings = {
    delimiters: ',| ',
    keepInvalidTags: true,
};


export default class Tags {
    constructor (input, autocompleteContainer, output) {
        this.search = instantsearch({
            indexName: 'tags',
            searchClient: algoliasearch(
                'F71RCAYCSV',
                '5d4f20eeae8c4a78d0dbdf8d6f38491d'
            ),
        });

        this.input = input;
        this.autocompleteContainer = autocompleteContainer;
        this.output = output;

        this.tags = {};

        this.init()
    }

    init () {
        this.tagify = new Tagify(this.input, settings);

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
            this.tagify.settings.whitelist.splice(0, this.tagify.settings.whitelist.length, ...indices[0].hits.map(el => el.name));
            this.tagify.loading(false).dropdown.show.call(this.tagify, currentRefinement);
        }
    };
}
