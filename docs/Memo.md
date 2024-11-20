# Atomicptr\Functional\Memo  

Helper for creating memoized functions





## Methods

| Name | Description |
|------|-------------|
|[__invoke](#memo__invoke)|Call the memoized function, this has an internal cache and will return the result of a prior call instead of calling it again|
|[make](#memomake)|Create a new memoized function from a Closure. This means we cache the result of the Closure using the parameters as the key.|




### Memo::__invoke  

**Description**

```php
public __invoke (void)
```

Call the memoized function, this has an internal cache and will return the result of a prior call instead of calling it again 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Memo::make  

**Description**

```php
public static make (void)
```

Create a new memoized function from a Closure. This means we cache the result of the Closure using the parameters as the key. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />

