export type IDirection = 'ltr';

export interface IMessages {
    [key: string]: string;
}

export interface ILanguage {
    locale: string;
    code: string;
    name: string;
    icon: string;
    direction: IDirection;
    messages: IMessages;
}
