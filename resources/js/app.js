/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom'

import Development from './constants/Server'
import ScheduleItem from './components/ScheduleItem'


class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            scheduleItems: [],
        };
    }

    render() {
        const ScheduleItems =  
            this.state.scheduleItems.map((item) => 
                <ScheduleItem item={item} key={item.id} />    
            ) 

        return (
            <div>
                { ScheduleItems }
            </div>
        );
    }

    componentDidMount() {
        axios
        .get(Development.url + '/schedules')
        .then(response => {
            console.log(response)
            this.setState({
                scheduleItems: response.data.data,
            });
        })
    }
}

ReactDOM.render(<App />, document.getElementById('root'));