const algoliasearch = require('algoliasearch/lite');
const instantsearch = require('instantsearch.js').default;
import {connectAutocomplete} from 'instantsearch.js/es/connectors';
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
    constructor(input, autocompleteContainer, output) {
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

        this.templates = {
            wrapper(input, settings) {
                return `<tags class="tagify ${settings.mode ? "tagify--" + settings.mode : ""} ${input.className}"
                        ${settings.readonly ? 'readonly aria-readonly="true"' : 'aria-haspopup="listbox" aria-expanded="false"'}
                        tabIndex="-1">
                <span contenteditable data-placeholder="${settings.placeholder || '&#8203;'}" aria-placeholder="${settings.placeholder || ''}"
                    class="tagify__input"></span>
            </tags>`
            },

            tag(value, tagData) {
                return `<tag title='${tagData.title || value}'
                contenteditable='false'
                spellcheck='false'
                tabIndex="-1"
                class='tagify__tag ${tagData.class ? tagData.class : ""}'
                ${this.getAttributes(tagData)}>
          <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
          <div>
              <span class='tagify__tag-text'>${value}</span>
          </div>
      </tag>`
            },

            dropdown(settings) {
                var _s = settings.dropdown,
                    className = `${_s.position == 'manual' ? "" : `tagify__dropdown tagify__dropdown--${_s.position}`} ${_s.classname}`.trim();

                return `<div class="${className}" role="listbox" aria-labelledby="dropdown">
                  <div class="tagify__dropdown__wrapper"></div>
              </div>`
            },

            dropdownItem(item) {
                return `<div ${this.getAttributes(item)}
                        class='tagify__dropdown__item ${item.class ? item.class : ""}'
                        tabindex="0"
                        role="option">${item.value}</div>`
            }
        }

        this.init()
    }

    init() {
        const initialTags = this.output.value;
        const whitelist = initialTags ? initialTags.split(' ').map(el => ({
            value: el.toLowerCase(),
            bold: el.toLowerCase().replace(/[ćčšđž]/g, m => stripCharacters[m])
        })) : [];

        this.tagify = new Tagify(
            this.input,
            {
                ...settings[this.settingsType],
                whitelist,
                templates: this.templates,
            },
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
    renderAutocomplete(renderOptions, isFirstRender) {
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
